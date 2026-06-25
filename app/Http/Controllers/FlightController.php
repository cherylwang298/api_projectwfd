<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    /**
     * Mengambil semua data flights dari database
     */
    public function getAllFlights(): JsonResponse
    {
        // Ambil semua data dari tabel flights
        $flights = DB::table('flights')->get();

        // Kembalikan dalam bentuk response JSON standar API
        return response()->json($flights, 200);
    }

    /**
     * Mengambil data flight spesifik berdasarkan ID
     */
    public function getFlightById(string $id): JsonResponse
    {
        $flight = DB::table('flights')->where('id', $id)->first();

        if (!$flight) {
            return response()->json([
                'status' => 'error',
                'message' => 'Flight tidak ditemukan'
            ], 404);
        }

        return response()->json($flight, 200);
    }
}