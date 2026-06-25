<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\JsonResponse;

class PropertyController extends Controller
{
    public function getAllProperties(): JsonResponse
    {
        // Ambil property beserta data units di dalamnya
        $properties = Property::with('units')->get();

        // Transformasi data untuk menyisipkan harga termurah (cheapest_price)
        $transformed = $properties->map(function ($property) {
            return [
                'id' => $property->id,
                'name' => $property->name,
                'type' => $property->type,
                'city' => $property->city,
                'address' => $property->address,
                'description' => $property->description,
                // Cari nilai minimal dari kolom price milik unit-unitnya
                'cheapest_price' => $property->units->min('price') ?? 0, 
                // Opsional: berikan rating acak atau default jika belum ada di API
                'rating' => 4.5 + (rand(0, 5) / 10), 
                'badge' => rand(0, 4) == 0 ? 'Popular' : null,
            ];
        });

        return response()->json($transformed, 200);
    }
}