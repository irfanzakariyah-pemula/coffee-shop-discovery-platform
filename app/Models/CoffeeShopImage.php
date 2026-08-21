<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoffeeShopImage extends Model
{
    protected $fillable = [
        'coffee_shop_id',
        'path',
        'is_primary',
        'order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'order' => 'integer',
    ];

    public function coffeeShop(): BelongsTo
    {
        return $this->belongsTo(CoffeeShop::class);
    }
}
