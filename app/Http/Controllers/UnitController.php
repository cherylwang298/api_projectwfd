<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;


class UnitController extends Controller
{
    //

    public function getAllUnits(){
        $units = Unit::with('property')->get();
        return response()->json($units);
    }


}
