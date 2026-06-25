<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Unit;


class UnitController extends Controller
{
    /**
     * Mengambil semua data units dari database
     */
    public function getAllUnits(): JsonResponse
    {
        // Ambil semua data unit
        $units = Unit::all();

        // Kembalikan dalam bentuk response JSON standar API
        return response()->json($units, 200);
    }

    /**
     * Mengambil data unit spesifik berdasarkan ID (jika nanti dibutuhkan)
     */
    public function getUnitById(string $id): JsonResponse
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit tidak ditemukan'
            ], 404);
        }

        return response()->json($unit, 200);
    }
}