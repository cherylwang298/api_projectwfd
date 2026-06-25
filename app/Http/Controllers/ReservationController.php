<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    //

    public function getAllReservations(){
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $request->validate([

            'unit_id' => 'required',

            'check_in' => 'required|date',

            'check_out' => 'required|date|after:check_in',

            'application_reservation_id' => 'required'
        ]);

        $reservation = Reservation::create([

            'unit_id' => $request->unit_id,

            'check_in' => $request->check_in,

            'check_out' => $request->check_out,

            'application_reservation_id'
                => $request->application_reservation_id,

        ]);

        return response()->json([
            'message' => 'Reservation created',
            'data' => $reservation
        ],201);
    }
}
