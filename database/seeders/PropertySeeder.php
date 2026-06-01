<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

    $properties = [
        ['name' => 'property A', 'type' => 'villa', 'city' => 'city A', 'address' => 'address A', 'description' => 'description A'],
        ['name' => 'property B', 'type' => 'hotel', 'city' => 'city B', 'address' => 'address B', 'description' => 'description B'],
        ['name' => 'property C', 'type' => 'resort', 'city' => 'city C', 'address' => 'address C', 'description' => 'description C'],
        ['name' => 'property D', 'type' => 'homestay', 'city' => 'city C', 'address' => 'address D', 'description' => 'description D'],
    ];

    foreach($properties as $p){
        Property::create($p);
    }

    }
}
