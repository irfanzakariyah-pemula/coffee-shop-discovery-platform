<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Coffee Shop Modern',
                'slug' => 'coffee-shop-modern',
                'icon' => '☕',
                'description' => 'Coffee shop dengan konsep modern dan minimalis',
            ],
            [
                'name' => 'Cafe Tradisional',
                'slug' => 'cafe-tradisional',
                'icon' => '🏠',
                'description' => 'Cafe dengan nuansa tradisional Indonesia',
            ],
            [
                'name' => 'Roastery',
                'slug' => 'roastery',
                'icon' => '🔥',
                'description' => 'Coffee shop yang fokus pada roasting dan kualitas biji kopi',
            ],
            [
                'name' => 'Coworking Space',
                'slug' => 'coworking-space',
                'icon' => '💼',
                'description' => 'Coffee shop dengan fasilitas coworking untuk bekerja',
            ],
            [
                'name' => 'Kafe Outdoor',
                'slug' => 'kafe-outdoor',
                'icon' => '🌳',
                'description' => 'Cafe dengan area outdoor dan taman',
            ],
            [
                'name' => 'Coffee & Eatery',
                'slug' => 'coffee-eatery',
                'icon' => '🍽️',
                'description' => 'Coffee shop dengan menu makanan lengkap',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
