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
        // 1. Seed Tabel Airlines dengan UUID dan IATA Code 2 Huruf
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

        // Insert airlines terlebih dahulu
        foreach ($airlines as $airline) {
            DB::table('airlines')->insert([
                'id'         => $airline['id'],
                'code'       => $airline['code'],
                'name'       => $airline['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Ambil daftar UUID airline yang baru dimasukkan untuk referensi flights
        $airlineIds = array_column($airlines, 'id');

        // 2. Daftar Bandara (Indonesia & Sekitarnya)
        $airports = ['CGK', 'DPS', 'SUB', 'KUL', 'SIN', 'SYD', 'MEL'];

        // 3. Rentang Waktu (26 Juni s.d. 10 Juli 2026)
        $startDate = Carbon::create(2026, 6, 26, 0, 0, 0);
        $endDate = Carbon::create(2026, 7, 10, 23, 59, 59);

        $flightsData = [];

        // Looping setiap hari dalam range tersebut
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            
            // Looping bandara asal
            foreach ($airports as $origin) {
                // Looping bandara tujuan
                foreach ($airports as $destination) {
                    
                    if ($origin !== $destination) {
                        
                        // Pilih airline acak
                        $randomAirlineId = $airlineIds[array_rand($airlineIds)];
                        
                        // Set jam keberangkatan acak (05:00 - 22:00)
                        $departureTime = $date->copy()->hour(rand(5, 22))->minute(rand(0, 59))->second(0);
                        
                        // Set durasi acak (60 - 300 menit)
                        $flightDurationMinutes = rand(60, 300);
                        $arrivalTime = $departureTime->copy()->addMinutes($flightDurationMinutes);

                        // Karena setiap pasang rute minimal harus ada 1 flight setiap harinya,
                        // kita buat per rute per hari langsung men-generate opsi kelasnya (Economy & Business)
                        $classes = ['economy', 'business'];

                        foreach ($classes as $class) {
                            // Setup kuota kursi dan harga berdasarkan kelas terbang
                            if ($class === 'business') {
                                $seats = rand(12, 36);         // Kursi bisnis lebih sedikit
                                $price = rand(3500000, 9000000); // Harga bisnis lebih mahal (Rupiah)
                            } else {
                                $seats = rand(150, 180);        // Kursi ekonomi lebih banyak
                                $price = rand(700000, 2500000);  // Harga ekonomi standar
                            }

                            $flightsData[] = [
                                'id'             => Str::uuid()->toString(), // Generate UUID untuk flight
                                'airline_id'     => $randomAirlineId,
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

                            // Chunk insert per 500 records agar hemat memory RAM saat migrasi
                            if (count($flightsData) >= 500) {
                                DB::table('flights')->insert($flightsData);
                                $flightsData = []; 
                            }
                        }
                    }
                }
            }
        }

        // Insert sisa data penerbangan yang masih ada di array
        if (!empty($flightsData)) {
            DB::table('flights')->insert($flightsData);
        }
    }
}