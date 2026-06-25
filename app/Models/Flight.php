<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    //

    use HasUuids;

    protected $table = 'flights';

    protected $fillable = [
        'airline_id',
        'origin',
        'destination',
        'departure_time',
        'arrival_time',
        'class',
        'seats',
        'price',
    ];
}
