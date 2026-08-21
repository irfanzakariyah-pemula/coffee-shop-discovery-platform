<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            ['name' => 'WiFi Gratis', 'icon' => '📶', 'description' => 'Internet WiFi gratis untuk pelanggan'],
            ['name' => 'Parkir', 'icon' => '🅿️', 'description' => 'Area parkir tersedia'],
            ['name' => 'Power Outlet', 'icon' => '🔌', 'description' => 'Stop kontak tersedia di setiap meja'],
            ['name' => 'AC', 'icon' => '❄️', 'description' => 'Ruangan ber-AC'],
            ['name' => 'Indoor', 'icon' => '🏠', 'description' => 'Area indoor tersedia'],
            ['name' => 'Outdoor', 'icon' => '🌳', 'description' => 'Area outdoor tersedia'],
            ['name' => 'Smoking Area', 'icon' => '🚬', 'description' => 'Area merokok terpisah'],
            ['name' => 'Musholla', 'icon' => '🕌', 'description' => 'Musholla tersedia'],
            ['name' => 'Meeting Room', 'icon' => '🏢', 'description' => 'Ruang meeting tersedia'],
            ['name' => 'Pet Friendly', 'icon' => '🐕', 'description' => 'Ramah hewan peliharaan'],
            ['name' => 'Live Music', 'icon' => '🎵', 'description' => 'Live music di waktu tertentu'],
            ['name' => 'Takeaway', 'icon' => '🥤', 'description' => 'Layanan takeaway tersedia'],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
