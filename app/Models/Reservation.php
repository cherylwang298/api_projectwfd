<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //

    use HasUuids;

    protected $table = 'reservations';

    protected $fillable = [
        'unit_id',
        'check_in',
        'check_out',
        'application_reservation_id'
    ];

}
