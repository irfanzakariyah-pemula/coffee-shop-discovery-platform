<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CoffeeShopFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Kopi Kenangan',
            'Janji Jiwa',
            'Fore Coffee',
            'Kopi Tuku',
            'Starbucks',
            'Coffee Smith',
            'Anomali Coffee',
            'Filosofi Kopi',
        ]) . ' ' . fake()->city();

        $cities = ['Surabaya', 'Malang', 'Sidoarjo', 'Pasuruan', 'Mojokerto'];
        $city = fake()->randomElement($cities);

        // Coordinates for Surabaya area
        $lat = fake()->latitude(-7.4, -7.2);
        $lng = fake()->longitude(112.6, 112.8);

        $priceMin = fake()->randomElement([10000, 15000, 20000, 25000]);
        $priceMax = $priceMin + fake()->numberBetween(15000, 50000);

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5),
            'description' => fake()->paragraph(3),
            'address' => fake()->streetAddress() . ', ' . $city,
            'city' => $city,
            'area' => fake()->randomElement(['Ngagel', 'Gubeng', 'Darmokali', 'Rungkut', 'Wonokromo', 'Dinoyo']),
            'latitude' => $lat,
            'longitude' => $lng,
            'phone' => fake()->phoneNumber(),
            'email' => fake()->optional()->safeEmail(),
            'price_min' => $priceMin,
            'price_max' => $priceMax,
            'rating_avg' => 0,
            'rating_count' => 0,
            'view_count' => fake()->numberBetween(0, 500),
            'is_active' => true,
            'category_id' => Category::factory(),
        ];
    }
}
