<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlockTime extends Model
{
    protected $fillable = [
        'city_pair_id',
        'duration',
    ];

    protected $casts = [
        'duration' => 'datetime',
    ];

    public function cityPair(): BelongsTo
    {
        return $this->belongsTo(CityPair::class);
    }
}
