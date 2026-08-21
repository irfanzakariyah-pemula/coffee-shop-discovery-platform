@extends('layouts.app')

@section('title', 'Temukan Coffee Shop Sempurna Untukmu')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-coffee-50 via-white to-coffee-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                Temukan Coffee Shop<br>
                <span class="text-coffee-600">Sempurna Untukmu</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Jelajahi coffee shop terbaik di sekitarmu dengan mudah. Temukan berdasarkan lokasi, fasilitas, atmosfer, harga, dan rating.
            </p>

            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ url('/coffee-shops') }}" method="GET" class="flex gap-2">
                    <div class="flex-1 relative">
                        <input type="text" 
                               name="search" 
                               placeholder="Cari coffee shop, atau lokasi..." 
                               class="w-full px-6 py-4 rounded-lg border-2 border-gray-200 focus:border-coffee-500 focus:ring focus:ring-coffee-200 transition">
                        <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="px-8 py-4 bg-coffee-600 text-white rounded-lg font-semibold hover:bg-coffee-700 transition">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Quick Filters -->
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                <a href="{{ url('/coffee-shops?filter=wifi') }}" class="px-4 py-2 bg-white rounded-full text-sm font-medium text-gray-700 border border-gray-200 hover:border-coffee-500 hover:text-coffee-600 transition">
                    📶 WiFi Gratis
                </a>
                <a href="{{ url('/coffee-shops?filter=parking') }}" class="px-4 py-2 bg-white rounded-full text-sm font-medium text-gray-700 border border-gray-200 hover:border-coffee-500 hover:text-coffee-600 transition">
                    🅿️ Parkir
                </a>
                <a href="{{ url('/coffee-shops?filter=outdoor') }}" class="px-4 py-2 bg-white rounded-full text-sm font-medium text-gray-700 border border-gray-200 hover:border-coffee-500 hover:text-coffee-600 transition">
                    🌳 Outdoor
                </a>
                <a href="{{ url('/coffee-shops?filter=power') }}" class="px-4 py-2 bg-white rounded-full text-sm font-medium text-gray-700 border border-gray-200 hover:border-coffee-500 hover:text-coffee-600 transition">
                    🔌 Power Outlet
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-coffee-600">150+</div>
                <div class="text-gray-600 mt-2">Coffee Shops</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-coffee-600">1,200+</div>
                <div class="text-gray-600 mt-2">Reviews</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-coffee-600">500+</div>
                <div class="text-gray-600 mt-2">Active Users</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-coffee-600">10+</div>
                <div class="text-gray-600 mt-2">Cities</div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Coffee Shops Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Coffee Shop Populer</h2>
                <p class="text-gray-600 mt-2">Coffee shop dengan rating terbaik minggu ini</p>
            </div>
            <a href="{{ url('/coffee-shops') }}" class="text-coffee-600 font-medium hover:text-coffee-700 transition">
                Lihat Semua →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Placeholder Cards -->
            @for ($i = 1; $i <= 3; $i++)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                <div class="h-48 bg-gradient-to-br from-coffee-200 to-coffee-300"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="text-xl font-semibold text-gray-900">Coffee Shop #{{ $i }}</h3>
                        <div class="flex items-center space-x-1">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm font-semibold">4.5</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Surabaya, Jawa Timur</p>
                    <div class="flex items-center justify-between">
                        <span class="text-coffee-600 font-semibold">Rp 15.000 - 50.000</span>
                        <a href="#" class="text-sm text-coffee-600 font-medium hover:text-coffee-700">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Kenapa Memilih Ngopikel?</h2>
            <p class="text-gray-600 mt-2">Temukan coffee shop dengan cara yang lebih smart</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-coffee-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-coffee-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Cari Berdasarkan Lokasi</h3>
                <p class="text-gray-600">Temukan coffee shop terdekat dari lokasimu dengan mudah</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-coffee-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-coffee-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Rating & Review Terpercaya</h3>
                <p class="text-gray-600">Baca review dari pengguna lain sebelum berkunjung</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-coffee-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-coffee-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Filter Berdasarkan Preferensi</h3>
                <p class="text-gray-600">Saring berdasarkan harga, fasilitas, dan kategori</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-br from-coffee-600 to-coffee-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Siap Menemukan Coffee Shop Favoritmu?
        </h2>
        <p class="text-xl text-coffee-100 mb-8">
            Daftar sekarang dan mulai menjelajahi ribuan coffee shop terbaik
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ url('/register') }}" class="px-8 py-4 bg-white text-coffee-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                Daftar Gratis
            </a>
            <a href="{{ url('/coffee-shops') }}" class="px-8 py-4 bg-coffee-700 text-white rounded-lg font-semibold hover:bg-coffee-800 transition border-2 border-white">
                Jelajah Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
