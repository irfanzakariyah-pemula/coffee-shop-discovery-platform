@extends('layouts.app')

@section('title', 'Jelajah Coffee Shop')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-900">Jelajah Coffee Shop</h1>
            <p class="mt-2 text-gray-600">Temukan {{ $coffeeShops->total() }} coffee shop di Indonesia</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-20">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter</h3>
                    
                    <form method="GET" action="{{ route('coffee-shops.index') }}" class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Nama atau lokasi..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                            <select name="city" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating Minimum</label>
                            <select name="rating" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
                                <option value="">Semua Rating</option>
                                <option value="4" {{ request('rating') == 4 ? 'selected' : '' }}>⭐ 4+</option>
                                <option value="3" {{ request('rating') == 3 ? 'selected' : '' }}>⭐ 3+</option>
                            </select>
                        </div>

                        <!-- Facilities -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                            <div class="space-y-2 max-h-48 overflow-y-auto">
                                @foreach($facilities as $facility)
                                    <label class="flex items-center">
                                        <input 
                                            type="checkbox" 
                                            name="facilities[]" 
                                            value="{{ $facility->id }}"
                                            {{ in_array($facility->id, request('facilities', [])) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-coffee-600 focus:ring-coffee-500">
                                        <span class="ml-2 text-sm text-gray-700">{{ $facility->icon }} {{ $facility->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="space-y-2">
                            <button type="submit" class="w-full bg-coffee-600 text-white py-2 rounded-lg hover:bg-coffee-700 transition">
                                Terapkan Filter
                            </button>
                            <a href="{{ route('coffee-shops.index') }}" class="block w-full text-center border border-gray-300 py-2 rounded-lg hover:bg-gray-50 transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Coffee Shop Grid -->
            <div class="lg:col-span-3">
                @if($coffeeShops->isEmpty())
                    <div class="bg-white rounded-lg shadow p-12 text-center">
                        <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada coffee shop ditemukan</h3>
                        <p class="text-gray-600 mb-4">Coba ubah filter atau kata kunci pencarian</p>
                        <a href="{{ route('coffee-shops.index') }}" class="text-coffee-600 hover:text-coffee-700 font-medium">
                            Reset Filter
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($coffeeShops as $shop)
                            <a href="{{ route('coffee-shops.show', $shop->slug) }}" class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden group">
                                <!-- Image -->
                                <div class="h-48 bg-gradient-to-br from-coffee-200 to-coffee-300 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-coffee-900 bg-opacity-0 group-hover:bg-opacity-10 transition"></div>
                                </div>

                                <!-- Content -->
                                <div class="p-4">
                                    <div class="flex items-start justify-between mb-2">
                                        <h3 class="font-semibold text-gray-900 group-hover:text-coffee-600 transition line-clamp-1">
                                            {{ $shop->name }}
                                        </h3>
                                        @if($shop->rating_count > 0)
                                            <div class="flex items-center space-x-1 flex-shrink-0 ml-2">
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <span class="text-sm font-semibold">{{ number_format($shop->rating_avg, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <p class="text-sm text-gray-600 mb-2">{{ $shop->area }}, {{ $shop->city }}</p>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-coffee-600 font-semibold text-sm">
                                            Rp {{ number_format($shop->price_min) }} - {{ number_format($shop->price_max) }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $shop->category->name }}
                                        </span>
                                    </div>

                                    <!-- Facilities Preview -->
                                    @if($shop->facilities->isNotEmpty())
                                        <div class="mt-3 flex flex-wrap gap-1">
                                            @foreach($shop->facilities->take(3) as $facility)
                                                <span class="text-xs">{{ $facility->icon }}</span>
                                            @endforeach
                                            @if($shop->facilities->count() > 3)
                                                <span class="text-xs text-gray-500">+{{ $shop->facilities->count() - 3 }}</span>
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
