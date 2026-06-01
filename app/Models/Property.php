<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Property extends Model
{
    //
     use HasUuids;

    protected $table = 'properties';

    protected $fillable = [
        'name',
        'type',
        'city',
        'address',
        'description',
    ];
}
