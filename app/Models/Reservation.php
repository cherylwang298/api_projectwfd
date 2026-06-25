<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Concerns\HasUuids;
>>>>>>> c6e2241aba8db31ba76161aaa2783cab16e92f24
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
<<<<<<< HEAD
=======

    use HasUuids;

    protected $table = 'reservations';

    protected $fillable = [
        'unit_id',
        'check_in',
        'check_out',
        'application_reservation_id'
    ];

>>>>>>> c6e2241aba8db31ba76161aaa2783cab16e92f24
}
