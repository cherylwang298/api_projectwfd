<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    use HasUuids;

    protected $table = 'images';
    protected $fillable = [
        'property_id',
        'unit_id',
        'path'
    ];
}
