<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CoffeeShop;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoffeeShopSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin Ngopikel',
            'email' => 'admin@ngopikel.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create regular users
        $users = User::factory(20)->create();

        // Get all categories and facilities
        $categories = Category::all();
        $facilities = Facility::all();

        // Realistic coffee shops in Surabaya area
        $coffeeShops = [
            [
                'name' => 'Kopi Kenangan Ngagel',
                'description' => 'Coffee shop modern dengan konsep minimalis. Menyediakan berbagai varian kopi berkualitas dengan harga terjangkau. Tempat favorit anak muda untuk nongkrong.',
                'address' => 'Jl. Ngagel Jaya Selatan No. 78, Surabaya',
                'city' => 'Surabaya',
                'area' => 'Ngagel',
                'latitude' => -7.2918,
                'longitude' => 112.7537,
                'phone' => '081234567890',
                'price_min' => 15000,
                'price_max' => 45000,
                'category_id' => $categories->where('slug', 'coffee-shop-modern')->first()->id,
            ],
            [
                'name' => 'Janji Jiwa Gubeng',
                'description' => 'Janji Jiwa Gubeng menawarkan kopi nusantara berkualitas dengan harga ramah dikantong. Suasana nyaman dengan WiFi gratis cocok untuk bekerja.',
                'address' => 'Jl. Gubeng Kertajaya No. 45, Surabaya',
                'city' => 'Surabaya',
                'area' => 'Gubeng',
                'latitude' => -7.2754,
                'longitude' => 112.7397,
                'phone' => '082345678901',
                'price_min' => 12000,
                'price_max' => 35000,
                'category_id' => $categories->where('slug', 'coffee-shop-modern')->first()->id,
            ],
            [
                'name' => 'Tuku Coffee Darmokali',
                'description' => 'Tuku Coffee terkenal dengan kopi susunya yang creamy dan rasa kopi yang kuat. Tempat yang nyaman dengan desain minimalis.',
                'address' => 'Jl. Raya Darmo No. 123, Surabaya',
                'city' => 'Surabaya',
                'area' => 'Darmokali',
                'latitude' => -7.2784,
                'longitude' => 112.7342,
                'phone' => '083456789012',
                'price_min' => 18000,
                'price_max' => 50000,
                'category_id' => $categories->where('slug', 'coffee-shop-modern')->first()->id,
            ],
            [
                'name' => 'Fore Coffee Rungkut',
                'description' => 'Fore Coffee menawarkan berbagai pilihan kopi dengan teknologi roasting modern. Cocok untuk meeting atau bekerja dengan suasana tenang.',
                'address' => 'Jl. Raya Kalirungkut No. 56, Surabaya',
                'city' => 'Surabaya',
                'area' => 'Rungkut',
                'latitude' => -7.3196,
                'longitude' => 112.7803,
                'phone' => '084567890123',
                'price_min' => 20000,
                'price_max' => 55000,
                'category_id' => $categories->where('slug', 'coworking-space')->first()->id,
            ],
            [
                'name' => 'Anomali Coffee Wonokromo',
                'description' => 'Anomali Coffee adalah roastery terkemuka yang menyajikan single origin coffee pilihan. Tempat yang sempurna untuk pecinta kopi sejati.',
                'address' => 'Jl. Wonokromo No. 89, Surabaya',
                'city' => 'Surabaya',
                'area' => 'Wonokromo',
                'latitude' => -7.2828,
                'longitude' => 112.7319,
                'phone' => '085678901234',
                'price_min' => 25000,
                'price_max' => 70000,
                'category_id' => $categories->where('slug', 'roastery')->first()->id,
            ],
            [
                'name' => 'Filosofi Kopi Malang',
                'description' => 'Terinspirasi dari film terkenal, Filosofi Kopi menyajikan kopi berkualitas dengan filosofi "setiap cangkir punya cerita". Suasana klasik dan nyaman.',
                'address' => 'Jl. Ijen No. 34, Malang',
                'city' => 'Malang',
                'area' => 'Ijen',
                'latitude' => -7.9666,
                'longitude' => 112.6326,
                'phone' => '086789012345',
                'price_min' => 20000,
                'price_max' => 60000,
                'category_id' => $categories->where('slug', 'cafe-tradisional')->first()->id,
            ],
            [
                'name' => 'Kopi Klotok Pakem Yogya',
                'description' => 'Kopi Klotok menawarkan pengalaman ngopi outdoor dengan pemandangan alam yang asri. Kopi diseduh dengan cara tradisional menggunakan anglo.',
                'address' => 'Jl. Kaliurang KM 19, Yogyakarta',
                'city' => 'Yogyakarta',
                'area' => 'Pakem',
                'latitude' => -7.7024,
                'longitude' => 110.4208,
                'price_min' => 10000,
                'price_max' => 30000,
                'category_id' => $categories->where('slug', 'kafe-outdoor')->first()->id,
            ],
            [
                'name' => 'Starbucks Tunjungan Plaza',
                'description' => 'Starbucks international coffee chain dengan berbagai pilihan kopi dan minuman signature. Tempat premium untuk meeting atau bersantai.',
                'address' => 'Tunjungan Plaza 5 Lt. 3, Surabaya',
                'city' => 'Surabaya',
                'area' => 'Tunjungan',
                'latitude' => -7.2633,
                'longitude' => 112.7382,
                'phone' => '087890123456',
                'price_min' => 35000,
                'price_max' => 85000,
                'category_id' => $categories->where('slug', 'coffee-shop-modern')->first()->id,
            ],
            [
                'name' => 'Tanamera Coffee Dinoyo',
                'description' => 'Tanamera Coffee menyajikan kopi dan makanan Indonesia modern dengan konsep cozy dan Instagrammable. Cocok untuk hang out bersama teman.',
                'address' => 'Jl. MT. Haryono No. 167, Malang',
                'city' => 'Malang',
                'area' => 'Dinoyo',
                'latitude' => -7.9678,
                'longitude' => 112.6207,
                'phone' => '088901234567',
                'price_min' => 18000,
                'price_max' => 55000,
                'category_id' => $categories->where('slug', 'coffee-eatery')->first()->id,
            ],
            [
                'name' => 'Ngopi Doeloe Sidoarjo',
                'description' => 'Cafe bergaya vintage dengan menu kopi tradisional dan modern. Tempat yang nyaman dengan hiasan antik yang menarik.',
                'address' => 'Jl. Raya Jenggolo No. 45, Sidoarjo',
                'city' => 'Sidoarjo',
                'area' => 'Jenggolo',
                'latitude' => -7.4482,
                'longitude' => 112.7183,
                'phone' => '089012345678',
                'price_min' => 12000,
                'price_max' => 40000,
                'category_id' => $categories->where('slug', 'cafe-tradisional')->first()->id,
            ],
        ];

        foreach ($coffeeShops as $shopData) {
            $shop = CoffeeShop::create([
                ...$shopData,
                'slug' => Str::slug($shopData['name']),
            ]);

            // Attach random facilities (3-6 facilities per shop)
            $randomFacilities = $facilities->random(rand(3, 6));
            $shop->facilities()->attach($randomFacilities->pluck('id'));

            // Create reviews for this coffee shop (3-8 reviews)
            $reviewCount = rand(3, 8);
            $ratings = [];
            
            // Get unique users for reviews (to avoid duplicate)
            $reviewers = $users->random(min($reviewCount, $users->count()));
            
            foreach ($reviewers as $reviewer) {
                $rating = rand(3, 5);
                $ratings[] = $rating;
                
                $shop->reviews()->create([
                    'user_id' => $reviewer->id,
                    'rating' => $rating,
                    'comment' => $this->getRandomReview($rating),
                ]);
            }

            // Update shop rating
            $shop->update([
                'rating_avg' => round(array_sum($ratings) / count($ratings), 2),
                'rating_count' => count($ratings),
            ]);
        }
    }

    private function getRandomReview($rating): string
    {
        $positiveReviews = [
            'Kopinya enak banget! Tempatnya juga nyaman dan WiFi kenceng.',
            'Pelayanannya ramah, kopinya mantap. Recommended!',
            'Salah satu coffee shop favorit saya. Suasananya cozy banget.',
            'Harga terjangkau, rasa tidak mengecewakan. Pasti balik lagi!',
            'Tempat yang pas untuk kerja sambil ngopi. Fasilitasnya lengkap.',
        ];

        $neutralReviews = [
            'Kopinya lumayan enak, tapi agak ramai di weekend.',
            'Tempatnya oke, cuma kadang pelayanannya agak lama.',
            'Overall bagus, tapi parkirannya terbatas.',
        ];

        $excellentReviews = [
            'Perfect! Dari rasa kopi, suasana, sampai pelayanan semua top!',
            'Coffee shop terbaik di area ini! Wajib coba!',
            'Gak nyesel deh datang kesini. Tempatnya aesthetic, kopinya juara!',
        ];

        if ($rating >= 5) {
            return $excellentReviews[array_rand($excellentReviews)];
        } elseif ($rating >= 4) {
            return $positiveReviews[array_rand($positiveReviews)];
        } else {
            return $neutralReviews[array_rand($neutralReviews)];
        }
    }
}
