<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Promotion extends Model
{
    protected $fillable = [
        'coffee_shop_id',
        'title',
        'description',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'min_purchase',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_value' => 'integer',
        'min_purchase' => 'integer',
        'is_active' => 'boolean',
    ];

    public function coffeeShop(): BelongsTo
    {
        return $this->belongsTo(CoffeeShop::class);
    }

    /**
     * Check if promotion is currently active
     */
    public function isCurrentlyActive(): bool
    {
        return $this->is_active 
            && $this->start_date <= now() 
            && $this->end_date >= now();
    }

    /**
     * Scope: Active promotions
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }

    /**
     * Get discount text
     */
    public function getDiscountTextAttribute(): string
    {
        return match($this->discount_type) {
            'percentage' => "{$this->discount_value}% OFF",
            'fixed' => "Diskon Rp " . number_format($this->discount_value, 0, ',', '.'),
            'buy_x_get_y' => "Buy {$this->discount_value} Get 1 Free",
            default => "Special Promo"
        };
    }
}
