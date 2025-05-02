<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slot extends Model
{
    protected $fillable = [
        'city_pair_id',
        'airline_id',
        'slot_time',
    ];

    protected $casts = [
        'slot_time' => 'datetime',
    ];

    public function cityPair(): BelongsTo
    {
        return $this->belongsTo(CityPair::class);
    }

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }
}
