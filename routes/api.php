<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\UnitController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/properties', [PropertyController::class, 'getAllProperties'])->name('properties');
Route::get('/airlines', [AirlineController::class, 'getAllAirlines'])->name('airlines');

Route::get('/units', [UnitController::class, 'getAllUnits'])->name('units');
Route::get('/units/{id}', [UnitController::class, 'getUnitById'])->name('units.show');

Route::get('/flights', [FlightController::class, 'getAllFlights'])->name('flights');
Route::get('/flights/{id}', [FlightController::class, 'getFlightById'])->name('flights.show');