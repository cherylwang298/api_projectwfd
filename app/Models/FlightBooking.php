<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    //
    use HasUuids;

    protected $table = 'flight_bookings';

    protected $fillable = [
        'application_reservation_id',
        'flight_id'
    ];


}
