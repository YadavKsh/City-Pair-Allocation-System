<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\CityPair;
use App\Models\Airline;
use App\Models\Slot;
use App\Models\BlockTime;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Seed cities
        $cities = [
            ['airport_code' => 'DEL', 'name' => 'Delhi'],
            ['airport_code' => 'BOM', 'name' => 'Mumbai'],
            ['airport_code' => 'BLR', 'name' => 'Bangalore'],
            ['airport_code' => 'MAA', 'name' => 'Chennai'],
            ['airport_code' => 'HYD', 'name' => 'Hyderabad'],
            ['airport_code' => 'CCU', 'name' => 'Kolkata'],
            ['airport_code' => 'COK', 'name' => 'Kochi'],
            ['airport_code' => 'PNQ', 'name' => 'Pune'],
            ['airport_code' => 'GOI', 'name' => 'Goa'],
            ['airport_code' => 'AMD', 'name' => 'Ahmedabad'],
        ];

        foreach ($cities as $cityData) {
            City::firstOrCreate(
                ['airport_code' => $cityData['airport_code']],
                ['name' => $cityData['name']]
            );
        }

        // Seed airlines
        $airlines = [
            ['name' => 'IndiGo', 'code' => '6E'],
            ['name' => 'Air India', 'code' => 'AI'],
            ['name' => 'Vistara', 'code' => 'UK'],
            ['name' => 'SpiceJet', 'code' => 'SG'],
            ['name' => 'AirAsia India', 'code' => 'I5'],
            ['name' => 'Go First', 'code' => 'G8'],
        ];

        foreach ($airlines as $airlineData) {
            Airline::firstOrCreate(
                ['code' => $airlineData['code']],
                ['name' => $airlineData['name']]
            );
        }

        // Create some sample city pairs and block times
        $cityPairs = [
            ['from' => 'DEL', 'to' => 'BOM', 'duration' => '02:10:00'],
            ['from' => 'DEL', 'to' => 'BLR', 'duration' => '02:45:00'],
            ['from' => 'DEL', 'to' => 'MAA', 'duration' => '02:30:00'],
            ['from' => 'BOM', 'to' => 'BLR', 'duration' => '01:45:00'],
            ['from' => 'BOM', 'to' => 'MAA', 'duration' => '01:50:00'],
            ['from' => 'BLR', 'to' => 'HYD', 'duration' => '01:15:00'],
            ['from' => 'DEL', 'to' => 'HYD', 'duration' => '02:00:00'],
            ['from' => 'BOM', 'to' => 'HYD', 'duration' => '01:30:00'],
        ];

        foreach ($cityPairs as $pair) {
            $fromCity = City::where('airport_code', $pair['from'])->first();
            $toCity = City::where('airport_code', $pair['to'])->first();

            if ($fromCity && $toCity) {
                $cityPair = CityPair::firstOrCreate([
                    'from_city' => $fromCity->id,
                    'to_city' => $toCity->id,
                ]);

                BlockTime::firstOrCreate(
                    ['city_pair_id' => $cityPair->id],
                    ['duration' => $pair['duration']]
                );
            }
        }

        // Create some sample slots
        $airline = Airline::where('code', '6E')->first();
        if ($airline) {
            $cityPair = CityPair::whereHas('fromCity', function($query) {
                $query->where('airport_code', 'DEL');
            })->whereHas('toCity', function($query) {
                $query->where('airport_code', 'BOM');
            })->first();

            if ($cityPair) {
                Slot::create([
                    'city_pair_id' => $cityPair->id,
                    'airline_id' => $airline->id,
                    'slot_time' => '09:30:00',
                ]);
            }
        }
    }
}
