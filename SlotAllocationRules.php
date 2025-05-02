<?php

namespace App\Rules;

use App\Models\Slot;
use App\Models\CityPair;
use Carbon\Carbon;

class SlotAllocationRules
{
    // Maximum slots per airline per city pair
    const MAX_SLOTS_PER_AIRLINE = 4;

    // Minimum time gap between slots (in minutes)
    const MIN_SLOT_GAP = 30;

    // Maximum slots per hour at an airport
    const MAX_SLOTS_PER_HOUR = 6;

    public static function validateSlotAllocation($airlineId, $cityPairId, $slotTime)
    {
        $errors = [];

        // Check maximum slots per airline for this city pair
        $airlineSlots = Slot::where('airline_id', $airlineId)
            ->where('city_pair_id', $cityPairId)
            ->count();

        if ($airlineSlots >= self::MAX_SLOTS_PER_AIRLINE) {
            $errors[] = "Maximum slots per airline (" . self::MAX_SLOTS_PER_AIRLINE . ") reached for this route";
        }

        // Check slot timing conflicts
        $slotTimeCarbon = Carbon::createFromFormat('H:i:s', $slotTime);
        $minTime = $slotTimeCarbon->copy()->subMinutes(self::MIN_SLOT_GAP);
        $maxTime = $slotTimeCarbon->copy()->addMinutes(self::MIN_SLOT_GAP);

        $conflictingSlots = Slot::where('city_pair_id', $cityPairId)
            ->whereBetween('slot_time', [$minTime->format('H:i:s'), $maxTime->format('H:i:s')])
            ->exists();

        if ($conflictingSlots) {
            $errors[] = "Slot time conflicts with existing slots. Minimum gap required: " . self::MIN_SLOT_GAP . " minutes";
        }

        // Check maximum slots per hour at origin airport
        $cityPair = CityPair::with('fromCity')->find($cityPairId);
        $hourStart = $slotTimeCarbon->copy()->startOfHour();
        $hourEnd = $slotTimeCarbon->copy()->endOfHour();

        $slotsInHour = Slot::whereHas('cityPair', function ($query) use ($cityPair) {
            $query->where('from_city', $cityPair->from_city);
        })
        ->whereBetween('slot_time', [$hourStart->format('H:i:s'), $hourEnd->format('H:i:s')])
        ->count();

        if ($slotsInHour >= self::MAX_SLOTS_PER_HOUR) {
            $errors[] = "Maximum slots per hour (" . self::MAX_SLOTS_PER_HOUR . ") reached at origin airport";
        }

        return $errors;
    }
} 