<?php

namespace Database\Factories;

use App\Models\CoffeeShop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'coffee_shop_id' => CoffeeShop::factory(),
            'rating' => fake()->numberBetween(3, 5),
            'comment' => fake()->optional(0.8)->paragraph(),
        ];
    }
}
