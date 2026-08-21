<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'coffee_shop_id',
        'name',
        'description',
        'category',
        'price',
        'image',
        'is_available',
    ];

    protected $casts = [
        'price' => 'integer',
        'is_available' => 'boolean',
    ];

    public function coffeeShop(): BelongsTo
    {
        return $this->belongsTo(CoffeeShop::class);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Scope: Available menus only
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
