<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/csv/images.json'));
        $images = json_decode($json, true);

        $this->command->info("Sedang memproses seed images...");

        foreach ($images as $img) {
            // 1. Cari Properinya terlebih dahulu berdasarkan nama properti
            $property = DB::table('properties')
                            ->where('name', $img['property_name'])
                            ->first();

            if (!$property) {
                $this->command->warn("Properti '{$img['property_name']}' tidak ditemukan di database.");
                continue;
            }

            $propertyId = null;
            $unitId = null;

            // 2. Tentukan apakah ini gambar Unit (Kamar) atau gambar Properti (Hotel/Villa)
            if (!empty($img['unit_name'])) {
                // Cari unit yang memiliki nama tersebut dan terhubung ke property_id terkait
                $unit = DB::table('units')
                            ->where('property_id', $property->id)
                            ->where('name', $img['unit_name'])
                            ->first();

                if ($unit) {
                    $unitId = $unit->id; // Gambar ditujukan untuk unit
                } else {
                    $this->command->warn("Unit '{$img['unit_name']}' untuk properti '{$img['property_name']}' tidak ditemukan.");
                    continue;
                }
            } else {
                // Jika unit_name kosong/null, gambar ditujukan untuk properti utama
                $propertyId = $property->id;
            }

            // 3. Insert ke database tabel images
            DB::table('images')->insert([
                'id'          => Str::uuid()->toString(),
                'property_id' => $propertyId, // Mengisi salah satu (nullable)
                'unit_id'     => $unitId,     // Mengisi salah satu (nullable)
                'path'  => $img['image_path'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $this->command->info("Seed data images selesai!");
    }
}