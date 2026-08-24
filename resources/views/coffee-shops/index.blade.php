@extends('layouts.app')

@section('title', 'Jelajah Coffee Shop')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Jelajah Coffee Shop</h1>
                    <p class="mt-2 text-gray-600 flex items-center gap-2">
                        <x-icon name="store" class="w-5 h-5 text-coffee-600" />
                        <span>Temukan <span class="font-semibold text-coffee-600">{{ $coffeeShops->total() }}</span> coffee shop di Indonesia</span>
                    </p>
                </div>
                <a href="{{ route('map.index') }}" class="hidden md:flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-coffee-600 to-coffee-700 text-white rounded-xl font-semibold hover:from-coffee-700 hover:to-coffee-800 transition-all shadow-lg hover:shadow-xl">
                    <x-icon name="map" class="w-5 h-5" />
                    <span>Lihat Peta</span>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-soft p-6 sticky top-20">
                    <div class="flex items-center gap-2 mb-6">
                        <x-icon name="filter" class="w-5 h-5 text-coffee-600" />
                        <h3 class="text-lg font-bold text-gray-900">Filter</h3>
                    </div>
                    
                    <form method="GET" action="{{ route('coffee-shops.index') }}" class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Cari</label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                                    <x-icon name="search" class="w-4 h-4 text-gray-400" />
                                </div>
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Nama atau lokasi..."
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-coffee-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <select name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-coffee-500 focus:border-transparent">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- City -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <x-icon name="location" class="w-4 h-4 text-coffee-600" />
                                <span>Kota</span>
                            </label>
                            <select name="city" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-coffee-500 focus:border-transparent">
                                <option value="">Semua Kota</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                        {{ $city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <x-icon name="star" class="w-4 h-4 text-yellow-500" />
                                <span>Rating Minimum</span>
                            </label>
                            <select name="rating" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-coffee-500 focus:border-transparent">
                                <option value="">Semua Rating</option>
                                <option value="4" {{ request('rating') == 4 ? 'selected' : '' }}>4+ ⭐</option>
                                <option value="3" {{ request('rating') == 3 ? 'selected' : '' }}>3+ ⭐</option>
                            </select>
                        </div>

                        <!-- Facilities -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Fasilitas</label>
                            <div class="space-y-2.5 max-h-48 overflow-y-auto pr-2">
                                @foreach($facilities as $facility)
                                    <label class="flex items-center group cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            name="facilities[]" 
                                            value="{{ $facility->id }}"
                                            {{ in_array($facility->id, request('facilities', [])) ? 'checked' : '' }}
                                            class="w-4 h-4 rounded border-gray-300 text-coffee-600 focus:ring-coffee-500 cursor-pointer">
                                        <span class="ml-3 text-sm text-gray-700 group-hover:text-coffee-600 transition">{{ $facility->icon }} {{ $facility->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="space-y-3 pt-4 border-t">
                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-coffee-600 to-coffee-700 text-white py-3 rounded-xl hover:from-coffee-700 hover:to-coffee-800 transition-all font-semibold shadow-lg hover:shadow-xl">
                                <x-icon name="filter" class="w-4 h-4" />
                                <span>Terapkan Filter</span>
                            </button>
                            <a href="{{ route('coffee-shops.index') }}" class="block w-full text-center border-2 border-gray-300 py-3 rounded-xl hover:bg-gray-50 transition font-medium text-gray-700">
                                Reset Filter
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Coffee Shop Grid -->
            <div class="lg:col-span-3">
                @if($coffeeShops->isEmpty())
                    <div class="bg-white rounded-2xl shadow-soft p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-icon name="coffee" class="w-10 h-10 text-gray-400" />
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tidak ada coffee shop ditemukan</h3>
                        <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian</p>
                        <a href="{{ route('coffee-shops.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-coffee-600 text-white rounded-xl font-semibold hover:bg-coffee-700 transition">
                            <x-icon name="arrow-right" class="w-5 h-5 rotate-180" />
                            <span>Reset Filter</span>
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($coffeeShops as $shop)
                            <a href="{{ route('coffee-shops.show', $shop->slug) }}" class="group bg-white rounded-2xl shadow-soft hover:shadow-soft-lg transition-all duration-300 overflow-hidden">
                                <!-- Image with Gradient Overlay -->
                                <div class="relative h-48 bg-gradient-to-br from-coffee-200 via-primary-200 to-coffee-300 overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                    <div class="absolute inset-0 bg-coffee-900 bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                                    
                                    <!-- Category Badge -->
                                    <div class="absolute top-3 left-3">
                                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-semibold text-coffee-700 shadow-lg">
                                            {{ $shop->category->name }}
                                        </span>
                                    </div>

                                    <!-- Rating Badge -->
                                    @if($shop->rating_count > 0)
                                        <div class="absolute top-3 right-3 flex items-center gap-1 px-2.5 py-1 bg-white/90 backdrop-blur-sm rounded-full shadow-lg">
                                            <x-icon name="star-solid" class="w-4 h-4 text-yellow-400" />
                                            <span class="text-sm font-bold text-gray-900">{{ number_format($shop->rating_avg, 1) }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-coffee-600 transition mb-2 line-clamp-1">
                                        {{ $shop->name }}
                                    </h3>

                                    <div class="flex items-start gap-1.5 text-gray-600 mb-3">
                                        <x-icon name="map-pin" class="w-4 h-4 flex-shrink-0 mt-0.5 text-coffee-600" />
                                        <span class="text-sm line-clamp-1">{{ $shop->area }}, {{ $shop->city }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-1.5 text-coffee-600">
                                            <x-icon name="currency" class="w-4 h-4" />
                                            <span class="font-semibold text-sm">
                                                Rp {{ number_format($shop->price_min) }} - {{ number_format($shop->price_max) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Facilities Preview -->
                                    @if($shop->facilities->isNotEmpty())
                                        <div class="flex flex-wrap gap-2 pt-3 border-t">
                                            @foreach($shop->facilities->take(4) as $facility)
                                                <span class="flex items-center gap-1 text-xs bg-gray-100 px-2 py-1 rounded-lg text-gray-700">
                                                    <span>{{ $facility->icon }}</span>
                                                    <span class="hidden sm:inline">{{ Str::limit($facility->name, 8) }}</span>
                                                </span>
                                            @endforeach
                                            @if($shop->facilities->count() > 4)
                                                <span class="text-xs bg-coffee-100 text-coffee-700 px-2 py-1 rounded-lg font-medium">
                                                    +{{ $shop->facilities->count() - 4 }} lainnya
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $coffeeShops->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
