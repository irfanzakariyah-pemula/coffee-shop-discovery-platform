@extends('layouts.app')

@section('title', 'Temukan Coffee Shop Sempurna Untukmu')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-coffee-50 via-white to-primary-50 py-24">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-coffee-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center animate-fade-in">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-soft mb-6 border border-coffee-200">
                <x-icon name="sparkles" class="w-4 h-4 text-coffee-600" />
                <span class="text-sm font-medium text-gray-700">Platform Terpercaya untuk Pencinta Kopi</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                Temukan Coffee Shop<br>
                <span class="bg-gradient-to-r from-coffee-600 via-coffee-700 to-primary-600 bg-clip-text text-transparent">Sempurna Untukmu</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                Jelajahi coffee shop terbaik di sekitarmu dengan mudah. Temukan berdasarkan lokasi, fasilitas, atmosfer, harga, dan rating.
            </p>

            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto animate-slide-up">
                <form action="{{ url('/coffee-shops') }}" method="GET" class="relative">
                    <div class="flex gap-3 shadow-soft-lg rounded-2xl bg-white p-2 border-2 border-coffee-100">
                        <div class="flex-1 relative">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <x-icon name="search" class="w-5 h-5 text-gray-400" />
                            </div>
                            <input type="text" 
                                   name="search" 
                                   placeholder="Cari coffee shop atau lokasi..." 
                                   class="w-full pl-12 pr-4 py-4 rounded-xl border-0 focus:ring-2 focus:ring-coffee-500 focus:outline-none text-gray-900 placeholder-gray-400">
                        </div>
                        <button type="submit" class="px-8 py-4 bg-gradient-to-r from-coffee-600 via-coffee-700 to-coffee-800 text-white rounded-xl font-semibold hover:from-coffee-700 hover:via-coffee-800 hover:to-coffee-900 transition-all duration-200 flex items-center gap-2 shadow-lg hover:shadow-xl">
                            <span>Cari</span>
                            <x-icon name="arrow-right" class="w-5 h-5" />
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Filters -->
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ url('/coffee-shops?facilities=1') }}" class="group px-5 py-2.5 bg-white rounded-full text-sm font-medium text-gray-700 border-2 border-gray-200 hover:border-coffee-500 hover:text-coffee-600 hover:bg-coffee-50 hover:shadow-soft transition-all duration-200 flex items-center gap-2">
                    <x-icon name="wifi" class="w-4 h-4" />
                    <span>WiFi Gratis</span>
                </a>
                <a href="{{ url('/coffee-shops?facilities=4') }}" class="group px-5 py-2.5 bg-white rounded-full text-sm font-medium text-gray-700 border-2 border-gray-200 hover:border-coffee-500 hover:text-coffee-600 hover:bg-coffee-50 hover:shadow-soft transition-all duration-200 flex items-center gap-2">
                    <x-icon name="truck" class="w-4 h-4" />
                    <span>Parkir</span>
                </a>
                <a href="{{ url('/coffee-shops?facilities=6') }}" class="group px-5 py-2.5 bg-white rounded-full text-sm font-medium text-gray-700 border-2 border-gray-200 hover:border-coffee-500 hover:text-coffee-600 hover:bg-coffee-50 hover:shadow-soft transition-all duration-200 flex items-center gap-2">
                    <x-icon name="sun" class="w-4 h-4" />
                    <span>Outdoor</span>
                </a>
                <a href="{{ url('/coffee-shops?facilities=2') }}" class="group px-5 py-2.5 bg-white rounded-full text-sm font-medium text-gray-700 border-2 border-gray-200 hover:border-coffee-500 hover:text-coffee-600 hover:bg-coffee-50 hover:shadow-soft transition-all duration-200 flex items-center gap-2">
                    <x-icon name="bolt" class="w-4 h-4" />
                    <span>Power Outlet</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-coffee-100 to-coffee-200 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                    <x-icon name="store" class="w-6 h-6 text-coffee-700" />
                </div>
                <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-coffee-600 via-coffee-700 to-coffee-800 bg-clip-text text-transparent mb-2">150+</div>
                <div class="text-gray-600 font-medium">Coffee Shops</div>
            </div>
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                    <x-icon name="star" class="w-6 h-6 text-primary-700" />
                </div>
                <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-primary-600 via-coffee-600 to-coffee-700 bg-clip-text text-transparent mb-2">1,200+</div>
                <div class="text-gray-600 font-medium">Reviews</div>
            </div>
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-coffee-100 to-coffee-200 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                    <x-icon name="users" class="w-6 h-6 text-coffee-700" />
                </div>
                <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-coffee-600 via-coffee-700 to-coffee-800 bg-clip-text text-transparent mb-2">500+</div>
                <div class="text-gray-600 font-medium">Active Users</div>
            </div>
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl mb-3 group-hover:scale-110 transition-transform">
                    <x-icon name="map" class="w-6 h-6 text-primary-700" />
                </div>
                <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-primary-600 via-coffee-600 to-coffee-700 bg-clip-text text-transparent mb-2">10+</div>
                <div class="text-gray-600 font-medium">Cities</div>
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
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-coffee-50 rounded-full mb-4">
                <x-icon name="sparkles" class="w-4 h-4 text-coffee-600" />
                <span class="text-sm font-semibold text-coffee-700">Kenapa Memilih Ngopikel?</span>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Temukan Coffee Shop dengan Cara yang Lebih Smart</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Platform terlengkap untuk menemukan coffee shop yang sesuai dengan kebutuhan Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group relative p-8 bg-gradient-to-br from-white to-gray-50 rounded-2xl border-2 border-gray-100 hover:border-coffee-200 hover:shadow-soft-lg transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-coffee-500 to-coffee-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                    <x-icon name="map-pin" class="w-7 h-7 text-white" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Cari Berdasarkan Lokasi</h3>
                <p class="text-gray-600 leading-relaxed">Temukan coffee shop terdekat dari lokasimu dengan mudah menggunakan fitur peta interaktif</p>
            </div>

            <div class="group relative p-8 bg-gradient-to-br from-white to-gray-50 rounded-2xl border-2 border-gray-100 hover:border-coffee-200 hover:shadow-soft-lg transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                    <x-icon name="star-solid" class="w-7 h-7 text-white" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Rating & Review Terpercaya</h3>
                <p class="text-gray-600 leading-relaxed">Baca review dari pengguna lain dan lihat rating terpercaya sebelum berkunjung</p>
            </div>

            <div class="group relative p-8 bg-gradient-to-br from-white to-gray-50 rounded-2xl border-2 border-gray-100 hover:border-coffee-200 hover:shadow-soft-lg transition-all duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-coffee-500 to-coffee-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                    <x-icon name="filter" class="w-7 h-7 text-white" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Filter Berdasarkan Preferensi</h3>
                <p class="text-gray-600 leading-relaxed">Saring berdasarkan harga, fasilitas, kategori, dan berbagai kriteria lainnya</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative py-24 overflow-hidden">
    <!-- Gradient Background dengan Red Theme -->
    <div class="absolute inset-0 bg-gradient-to-br from-coffee-600 via-coffee-700 to-coffee-900"></div>
    
    <!-- Pattern Overlay -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="animate-fade-in">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                <x-icon name="sparkles" class="w-4 h-4 text-white" />
                <span class="text-sm font-medium text-white">Mulai Petualangan Kopimu</span>
            </div>

            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                Siap Menemukan Coffee Shop<br>Favoritmu?
            </h2>
            <p class="text-xl text-coffee-100 mb-10 max-w-2xl mx-auto leading-relaxed">
                Daftar sekarang dan mulai menjelajahi ribuan coffee shop terbaik di Indonesia
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ url('/register') }}" class="group px-8 py-4 bg-white text-coffee-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200 shadow-xl hover:shadow-2xl hover:scale-105 flex items-center justify-center gap-2">
                    <span>Daftar Gratis</span>
                    <x-icon name="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                </a>
                <a href="{{ url('/coffee-shops') }}" class="group px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-xl font-semibold hover:bg-white/20 transition-all duration-200 border-2 border-white/30 hover:border-white/50 flex items-center justify-center gap-2">
                    <x-icon name="coffee" class="w-5 h-5" />
                    <span>Jelajah Sekarang</span>
                </a>
            </div>
            
            <!-- Trust Indicators -->
            <div class="mt-12 flex flex-wrap justify-center items-center gap-8 text-white/80">
                <div class="flex items-center gap-2">
                    <x-icon name="check" class="w-5 h-5" />
                    <span class="text-sm">Gratis Selamanya</span>
                </div>
                <div class="flex items-center gap-2">
                    <x-icon name="check" class="w-5 h-5" />
                    <span class="text-sm">Tanpa Iklan</span>
                </div>
                <div class="flex items-center gap-2">
                    <x-icon name="check" class="w-5 h-5" />
                    <span class="text-sm">Komunitas Aktif</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
