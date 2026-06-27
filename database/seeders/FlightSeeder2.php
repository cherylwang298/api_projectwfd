<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FlightSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            ['id' => Str::uuid()->toString(), 'code' => 'GA', 'name' => 'Garuda Indonesia'],
            ['id' => Str::uuid()->toString(), 'code' => 'JT', 'name' => 'Lion Air'],
            ['id' => Str::uuid()->toString(), 'code' => 'ID', 'name' => 'Batik Air'],
            ['id' => Str::uuid()->toString(), 'code' => 'QG', 'name' => 'Citilink'],
            ['id' => Str::uuid()->toString(), 'code' => 'AK', 'name' => 'AirAsia Malaysia'],
            ['id' => Str::uuid()->toString(), 'code' => 'SQ', 'name' => 'Singapore Airlines'],
            ['id' => Str::uuid()->toString(), 'code' => 'TR', 'name' => 'Scoot'],
            ['id' => Str::uuid()->toString(), 'code' => 'QF', 'name' => 'Qantas'],
            ['id' => Str::uuid()->toString(), 'code' => 'JQ', 'name' => 'Jetstar'],
        ];
           foreach ($airlines as $airline) {
            DB::table('airlines')->insert([
                'id'         => $airline['id'],
                'code'       => $airline['code'],
                'name'       => $airline['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Ambil daftar UUID airline untuk referensi flights
        $airlineIds = array_column($airlines, 'id');

        // 2. Daftar Bandara
        $airports = ['CGK', 'DPS', 'SUB', 'KUL', 'SIN', 'SYD', 'MEL'];

   
        $startDate = Carbon::create(2026, 6, 26, 0, 0, 0);
        $endDate = Carbon::create(2026, 7, 10, 23, 59, 59);

        $flightsData = [];

     
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            
            foreach ($airports as $origin) {
                foreach ($airports as $destination) {
                    
                    if ($origin !== $destination) {
                        
                      
                        $isSydDpsRoute = ($origin === 'SYD' && $destination === 'DPS') || ($origin === 'DPS' && $destination === 'SYD');
                        $iterations = $isSydDpsRoute ? 5 : 1;

                        $shuffledAirlines = $airlineIds;
                        shuffle($shuffledAirlines);

                        for ($i = 0; $i < $iterations; $i++) {
                            $currentAirlineId = $shuffledAirlines[$i];

                            $departureTime = $date->copy()->hour(rand(5, 22))->minute(rand(0, 59))->second(0);
                            
                            $flightDurationMinutes = $isSydDpsRoute ? rand(360, 420) : rand(60, 300);
                            $arrivalTime = $departureTime->copy()->addMinutes($flightDurationMinutes);

                            $classes = ['economy', 'business'];

                            foreach ($classes as $class) {
                                if ($class === 'business') {
                                    $seats = rand(12, 36);
                                    $price = $isSydDpsRoute ? rand(12000000, 25000000) : rand(3500000, 9000000);
                                } else {
                                    $seats = rand(150, 180);
                                    $price = $isSydDpsRoute ? rand(4000000, 8500000) : rand(700000, 2500000);
                                }

                                $flightsData[] = [
                                    'id'             => Str::uuid()->toString(),
                                    'airline_id'     => $currentAirlineId,
                                    'origin'         => $origin,
                                    'destination'    => $destination,
                                    'departure_time' => $departureTime->toDateTimeString(),
                                    'arrival_time'   => $arrivalTime->toDateTimeString(),
                                    'class'          => $class,
                                    'seats'          => $seats,
                                    'price'          => $price,
                                    'created_at'     => now(),
                                    'updated_at'     => now(),
                                ];

                                if (count($flightsData) >= 500) {
                                    DB::table('flights')->insert($flightsData);
                                    $flightsData = []; 
                                }
                            }
                        }
                    }
                }
            }
        }

        if (!empty($flightsData)) {
            DB::table('flights')->insert($flightsData);
        }
    }
}