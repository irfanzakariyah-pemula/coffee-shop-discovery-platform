<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    /**
     * Facilities belong to many coffee shops (many-to-many)
     */
    public function coffeeShops(): BelongsToMany
    {
        return $this->belongsToMany(CoffeeShop::class);
    }
}
