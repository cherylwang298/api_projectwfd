<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/properties', [PropertyController::class, 'getAllProperties'])->name('properties');