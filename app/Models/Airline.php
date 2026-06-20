<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;


class Airline extends Model
{
    //

    use HasUuids;

    protected $table = 'airlines';

    protected $fillable = [
        'name',
        'code'
    ];
}
