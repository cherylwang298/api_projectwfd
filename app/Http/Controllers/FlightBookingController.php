<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight; // Pastikan model Flight di-import untuk update data seats
use Illuminate\Support\Facades\DB;

class FlightBookingController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi struktur request yang dikirim oleh Main Repo
        $request->validate([
            'application_booking_id' => 'required',
            'booking_code'           => 'required|string',
            'tickets'                => 'required|array',
            'tickets.*.flight_id'    => 'required',
            'tickets.*.seat_type'    => 'required|string',
        ]);

        // Menggunakan Database Transaction API agar jika salah satu flight gagal, data tidak korup
        DB::beginTransaction();

        try {
            // 2. Lakukan perulangan untuk mengurangi kuota kursi di setiap flight_id yang dipesan
            foreach ($request->tickets as $ticketData) {
                
                // Cari data penerbangan berdasarkan flight_id di database API
                $flight = Flight::find($ticketData['flight_id']);
                
                if (!$flight) {
                    throw new \Exception("Flight dengan ID {$ticketData['flight_id']} tidak ditemukan di API.");
                }

                // Proteksi opsional: Cek apakah kursi masih tersedia
                if ($flight->seats <= 0) {
                    throw new \Exception("Gagal Booking! Sisa kursi saat ini di database API adalah: " . $flight->seats);
                    // throw new \Exception("Gagal Booking! Kursi untuk penerbangan {$flight->id} sudah penuh.");
                }

                // Kurangi nilai kolom seats_left sebanyak 1
                $flight->decrement('seats');
            }

            DB::commit();

            // 3. Kembalikan response sukses berbentuk JSON ke Main Repo
            return response()->json([
                'status'  => 'success',
                'message' => 'Seats left updated successfully',
                'booking_code' => $request->booking_code
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}