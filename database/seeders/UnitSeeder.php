<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/csv/units.json'));
        $units = json_decode($json, true);

        $this->command->info("Sedang memproses seed units...");

        foreach ($units as $unit) {
            // Cari properti di database berdasarkan nama properti dari JSON
            $property = DB::table('properties')
                            ->where('name', $unit['property_name'])
                            ->first();

            if ($property) {
                DB::table('units')->insert([
                    'id'          => Str::uuid()->toString(), // Karena id tabel units biasanya UUID juga
                    'property_id' => $property->id,           // Menghubungkan foreign key secara otomatis
                    'name'        => $unit['name'],
                    'capacity'    => $unit['capacity'],
                    'price'       => $unit['price'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            } else {
                $this->command->warn("Properti dengan nama '{$unit['property_name']}' tidak ditemukan di database.");
            }
        }

        $this->command->info("Seed units selesai!");
    }
}