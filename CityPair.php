<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CityPair extends Model
{
    protected $fillable = [
        'from_city',
        'to_city',
    ];

    public function fromCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'from_city');
    }

    public function toCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'to_city');
    }

    public function blockTime(): HasOne
    {
        return $this->hasOne(BlockTime::class);
    }

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class);
    }
}
