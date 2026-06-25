<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class, 'property_id');
    }
}
