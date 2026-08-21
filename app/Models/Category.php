<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
    ];

    /**
     * A category has many coffee shops
     */
    public function coffeeShops(): HasMany
    {
        return $this->hasMany(CoffeeShop::class);
    }
}
