<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CoffeeShop extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'address',
        'city',
        'area',
        'latitude',
        'longitude',
        'phone',
        'email',
        'price_min',
        'price_max',
        'rating_avg',
        'rating_count',
        'view_count',
        'is_active',
        'category_id',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'rating_avg' => 'decimal:2',
        'is_active' => 'boolean',
        'price_min' => 'integer',
        'price_max' => 'integer',
        'rating_count' => 'integer',
        'view_count' => 'integer',
    ];

    /**
     * Coffee shop belongs to a category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Coffee shop belongs to many facilities (many-to-many)
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class);
    }

    /**
     * Coffee shop has many images
     */
    public function images(): HasMany
    {
        return $this->hasMany(CoffeeShopImage::class);
    }

    /**
     * Get primary image
     */
    public function primaryImage()
    {
        return $this->hasOne(CoffeeShopImage::class)->where('is_primary', true);
    }

    /**
     * Coffee shop has many opening hours
     */
    public function openingHours(): HasMany
    {
        return $this->hasMany(OpeningHour::class);
    }

    /**
     * Coffee shop has many reviews
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Coffee shop has many favorites
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Coffee shop has many menus
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Coffee shop has many promotions
     */
    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }

    /**
     * Get active promotions only
     */
    public function activePromotions()
    {
        return $this->promotions()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now());
    }

    /**
     * Scope: Active coffee shops only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Search by name, address, or area
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('address', 'like', "%{$term}%")
              ->orWhere('area', 'like', "%{$term}%")
              ->orWhere('city', 'like', "%{$term}%");
        });
    }

    /**
     * Scope: Filter by city
     */
    public function scopeInCity($query, $city)
    {
        return $query->where('city', $city);
    }

    /**
     * Scope: Filter by price range
     */
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price_min', [$min, $max])
                     ->orWhereBetween('price_max', [$min, $max]);
    }

    /**
     * Scope: Minimum rating
     */
    public function scopeMinRating($query, $rating)
    {
        return $query->where('rating_avg', '>=', $rating);
    }
}
