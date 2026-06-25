<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Path ke file CSV
        $csvFile = database_path('seeders/csv/flights.csv');
        
        if (!file_exists($csvFile)) {
            $this->command->error("File CSV tidak ditemukan di: {$csvFile}");
            return;
        }

        // 2. Ambil data 'id' dari tabel airlines yang sudah di-seed sebelumnya
        // Ini penting karena flights Anda punya foreign key ke airlines
        $airlineIds = DB::table('airlines')->pluck('id')->toArray();

        if (empty($airlineIds)) {
            $this->command->error("Tabel airlines masih kosong! Seed airlines terlebih dahulu.");
            return;
        }

        // 3. Buka dan baca file CSV
        $fileHandle = fopen($csvFile, 'r');
        
        // Lewati baris pertama jika itu adalah header kolom
        $header = fgetcsv($fileHandle, 1000, ",");

        $this->command->info("Sedang memasukkan data flights dari CSV...");

        while (($row = fgetcsv($fileHandle, 1000, ",")) !== FALSE) {
    
            // Karena indeks $row[0] adalah kolom 'id' bawaan csv (0, 1, 2...), 
            // maka kolom data lainnya bergeser mulai dari indeks ke-1:
            try {
                $year  = $row[1]; // Kolom 'year'
                $month = str_pad($row[2], 2, '0', STR_PAD_LEFT); // Kolom 'month'
                $day   = str_pad($row[3], 2, '0', STR_PAD_LEFT); // Kolom 'day'
                
                // Asumsi kolom ke-5 ($row[4]) adalah jam keberangkatan (dep_time)
                $depTimeRaw = str_pad($row[4] ?? '0000', 4, '0', STR_PAD_LEFT); 
                $hour   = substr($depTimeRaw, 0, 2);
                $minute = substr($depTimeRaw, 2, 2);
                
                $departureTimestamp = Carbon::create($year, $month, $day, $hour, $minute, 0);
                $arrivalTimestamp   = $departureTimestamp->copy()->addHours(2); // Simulasi durasi 2 jam

            } catch (\Exception $e) {
                $departureTimestamp = Carbon::now();
                $arrivalTimestamp   = Carbon::now()->addHours(2);
            }

            // Ambil acak ID maskapai dari tabel airlines yang sudah ada datanya
            $randomAirlineId = $airlineIds[array_rand($airlineIds)];

            // Masukkan data ke database
            DB::table('flights')->insert([
                'id'             => Str::uuid()->toString(), // Kita generate UUID baru secara otomatis, abaikan 'id' (0,1,2..) dari CSV
                'airline_id'     => $randomAirlineId,        // Memenuhi foreign key
                'origin'         => $row[8] ?? 'SUB',        // Sesuaikan urutan kolom nama bandara asal Anda
                'destination'    => $row[9] ?? 'CGK',        // Sesuaikan urutan kolom nama bandara tujuan Anda
                'departure_time' => $departureTimestamp,
                'arrival_time'   => $arrivalTimestamp,
                'class'          => collect(['business', 'economy'])->random(),
                'seats'          => rand(50, 180),
                'price'          => rand(500000, 3000000),
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ]);
        }

        fclose($fileHandle);
        $this->command->info("Data flights berhasil dimasukkan!");
    }
}