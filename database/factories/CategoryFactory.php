<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Coffee Shop Modern',
            'Cafe Tradisional',
            'Roastery',
            'Coworking Space',
            'Kafe Outdoor',
            'Coffee & Eatery',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' => '☕',
            'description' => fake()->sentence(),
        ];
    }
}
