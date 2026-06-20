<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;

class AirlineController extends Controller
{
    //
     public function getAllAirlines(){
        $airlines = Airline::all();
        return response()->json($airlines);
    }
}
