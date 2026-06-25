<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    use HasUuids;

    protected $table = 'units';

    protected $fillable = [
        'property_id',
        'name',
        'description',
        'capacity',
        'price',
    ];

     public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
