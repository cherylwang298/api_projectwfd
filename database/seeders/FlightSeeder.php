<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = database_path('seeders/csv/flights.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan: {$csvFile}");
            return;
        }

        $airlineIds = DB::table('airlines')->pluck('id')->toArray();

        if (empty($airlineIds)) {
            $this->command->error("Tabel airlines kosong!");
            return;
        }

        $handle = fopen($csvFile, 'r');

        // Skip header
        fgetcsv($handle);

        $this->command->info('Memulai import flights...');

        $batchSize = 50;
        $batch = [];
        $inserted = 0;

        $now = now();

        while (($row = fgetcsv($handle, 0, ",")) !== false) {

            try {

                $year  = (int) $row[1];
                $month = (int) $row[2];
                $day   = (int) $row[3];

                $depTime = preg_replace('/[^0-9]/', '', $row[4] ?? '');

                if (empty($depTime)) {
                    $depTime = '0000';
                }

                $depTime = str_pad($depTime, 4, '0', STR_PAD_LEFT);

                $hour   = (int) substr($depTime, 0, 2);
                $minute = (int) substr($depTime, 2, 2);

                if ($hour > 23) {
                    $hour = 0;
                }

                if ($minute > 59) {
                    $minute = 0;
                }

                $departureTime = Carbon::create(
                    $year,
                    $month,
                    $day,
                    $hour,
                    $minute,
                    0
                );

                $arrivalTime = $departureTime->copy()->addHours(2);

            } catch (\Exception $e) {

                $departureTime = $now;
                $arrivalTime = $now->copy()->addHours(2);
            }

            $batch[] = [
                'id'             => (string) Str::uuid(),
                'airline_id'     => $airlineIds[array_rand($airlineIds)],

                // CSV flights dataset
                'origin'         => $row[13] ?? 'SUB',
                'destination'    => $row[14] ?? 'CGK',

                'departure_time' => $departureTime,
                'arrival_time'   => $arrivalTime,

                'class'          => rand(0, 1) ? 'business' : 'economy',
                'seats'          => rand(50, 180),
                'price'          => rand(500000, 3000000),

                'created_at'     => $now,
                'updated_at'     => $now,
            ];

            if (count($batch) >= $batchSize) {

                DB::table('flights')->insert($batch);

                $inserted += count($batch);

                $this->command->info("Inserted {$inserted} rows...");

                $batch = [];
            }
        }

        if (!empty($batch)) {
            DB::table('flights')->insert($batch);
            $inserted += count($batch);
        }

        fclose($handle);

        $this->command->info("Selesai! Total {$inserted} flights berhasil diimport.");
    }
}