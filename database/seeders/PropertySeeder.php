<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = file_get_contents(database_path('seeders/csv/properties.json'));
        $properties = json_decode($json, true);

        foreach ($properties as $prop) {
            DB::table('properties')->insert([
                'id' => Str::uuid()->toString(), 
                'name' => $prop['name'],
                'type' => $prop['type'],
                'city' => $prop['city'],
                'address' => $prop['address'],
                'description' => $prop['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
