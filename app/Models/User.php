<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * User has many reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * User has many favorites
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * User's favorite coffee shops (many-to-many through favorites)
     */
    public function favoriteCoffeeShops()
    {
        return $this->belongsToMany(CoffeeShop::class, 'favorites')
                    ->withTimestamps();
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user has favorited a coffee shop
     */
    public function hasFavorited(CoffeeShop $coffeeShop): bool
    {
        return $this->favorites()
                    ->where('coffee_shop_id', $coffeeShop->id)
                    ->exists();
    }
}
