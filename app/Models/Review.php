<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'coffee_shop_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coffeeShop(): BelongsTo
    {
        return $this->belongsTo(CoffeeShop::class);
    }

    /**
     * Boot method to update coffee shop rating when review is created/updated
     */
    protected static function booted()
    {
        static::created(function ($review) {
            $review->updateCoffeeShopRating();
        });

        static::updated(function ($review) {
            $review->updateCoffeeShopRating();
        });

        static::deleted(function ($review) {
            $review->updateCoffeeShopRating();
        });
    }

    /**
     * Update coffee shop average rating
     */
    public function updateCoffeeShopRating()
    {
        $coffeeShop = $this->coffeeShop;
        
        $avgRating = $coffeeShop->reviews()->avg('rating');
        $ratingCount = $coffeeShop->reviews()->count();

        $coffeeShop->update([
            'rating_avg' => round($avgRating, 2),
            'rating_count' => $ratingCount,
        ]);
    }
}
