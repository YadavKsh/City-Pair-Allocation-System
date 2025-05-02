<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\City;
use App\Models\Airline;
use App\Models\BlockTime;
use App\Rules\SlotAllocationRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SlotController extends Controller
{
    public function index()
    {
        $slots = Slot::with(['cityPair.fromCity', 'cityPair.toCity', 'airline', 'cityPair.blockTime'])
            ->get()
            ->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'airline' => $slot->airline->name . ' (' . $slot->airline->code . ')',
                    'from_city' => $slot->cityPair->fromCity->name . ' (' . $slot->cityPair->fromCity->airport_code . ')',
                    'to_city' => $slot->cityPair->toCity->name . ' (' . $slot->cityPair->toCity->airport_code . ')',
                    'slot_time' => $slot->slot_time,
                    'block_time' => $slot->cityPair->blockTime->duration,
                ];
            });

        $cities = City::all();
        $airlines = Airline::all();

        return view('slots.index', compact('slots', 'cities', 'airlines'));
    }

    public function store(Request $request)
    {
        try {
            // Convert auto_duration to boolean
            $request->merge(['auto_duration' => $request->input('auto_duration') === '1']);

            $validated = $request->validate([
                'from_city' => 'required|exists:cities,airport_code',
                'to_city' => 'required|exists:cities,airport_code|different:from_city',
                'airline' => 'required|exists:airlines,code',
                'slot_time' => 'required|date_format:H:i',
                'auto_duration' => 'boolean',
                'block_time' => 'required_if:auto_duration,false',
            ]);

            DB::beginTransaction();

            // Get city IDs
            $fromCity = City::where('airport_code', $validated['from_city'])->first();
            $toCity = City::where('airport_code', $validated['to_city'])->first();
            $airline = Airline::where('code', $validated['airline'])->first();

            if (!$fromCity || !$toCity || !$airline) {
                throw new \Exception('Required records not found in database');
            }

            // Create or get city pair
            $cityPair = \App\Models\CityPair::firstOrCreate([
                'from_city' => $fromCity->id,
                'to_city' => $toCity->id,
            ]);

            // Format the slot time
            $formattedSlotTime = $validated['slot_time'] . ':00';

            // Validate slot allocation rules
            $allocationErrors = SlotAllocationRules::validateSlotAllocation(
                $airline->id,
                $cityPair->id,
                $formattedSlotTime
            );

            if (!empty($allocationErrors)) {
                throw new \Exception(implode("\n", $allocationErrors));
            }

            // Handle block time
            if ($validated['auto_duration']) {
                $blockTime = BlockTime::firstOrCreate(
                    ['city_pair_id' => $cityPair->id],
                    ['duration' => '02:10:00']
                );
            } else {
                $formattedBlockTime = $validated['block_time'] . ':00';
                $blockTime = BlockTime::updateOrCreate(
                    ['city_pair_id' => $cityPair->id],
                    ['duration' => $formattedBlockTime]
                );
            }

            // Create slot
            $slot = Slot::create([
                'city_pair_id' => $cityPair->id,
                'airline_id' => $airline->id,
                'slot_time' => $formattedSlotTime,
            ]);

            DB::commit();
            return redirect()->route('slots.index')->with('success', 'Slot created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating slot:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('slots.index')
                ->with('error', 'Failed to create slot: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, Slot $slot)
    {
        $validated = $request->validate([
            'slot_time' => 'required|date_format:H:i',
            'block_time' => 'required|date_format:H:i',
        ]);

        $slot->update([
            'slot_time' => $validated['slot_time'] . ':00',
        ]);

        $slot->cityPair->blockTime->update([
            'duration' => $validated['block_time'] . ':00',
        ]);

        return redirect()->route('slots.index')->with('success', 'Slot updated successfully');
    }

    public function destroy(Slot $slot)
    {
        $slot->delete();
        return redirect()->route('slots.index')->with('success', 'Slot deleted successfully');
    }
} 