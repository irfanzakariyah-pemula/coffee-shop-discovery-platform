@extends('layouts.app')

@section('title', $coffeeShop->name)

@section('content')
<div class="bg-gray-50 min-h-screen pb-12">
    <!-- Hero Section with Image -->
    <div class="relative h-96 bg-gradient-to-br from-coffee-300 via-primary-300 to-coffee-400 overflow-hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>
        
        <!-- Content -->
        <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-end pb-12">
            <!-- Back Button -->
            <a href="{{ route('coffee-shops.index') }}" class="absolute top-8 left-4 sm:left-6 lg:left-8 inline-flex items-center gap-2 px-4 py-2 bg-white/90 backdrop-blur-sm text-gray-900 rounded-xl font-medium hover:bg-white transition shadow-lg">
                <x-icon name="arrow-right" class="w-4 h-4 rotate-180" />
                <span>Kembali</span>
            </a>

            <!-- Category Badge -->
            <div class="mb-4">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/90 backdrop-blur-sm rounded-full text-sm font-semibold text-coffee-700 shadow-lg">
                    <x-icon name="store" class="w-4 h-4" />
                    <span>{{ $coffeeShop->category->name }}</span>
                </span>
            </div>

            <!-- Title & Rating -->
            <div class="flex items-end justify-between gap-4">
                <div class="flex-1">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 drop-shadow-lg">{{ $coffeeShop->name }}</h1>
                    <div class="flex items-center gap-2 text-white/90">
                        <x-icon name="map-pin" class="w-5 h-5" />
                        <span class="font-medium">{{ $coffeeShop->area }}, {{ $coffeeShop->city }}</span>
                    </div>
                </div>

                @if($coffeeShop->rating_count > 0)
                    <div class="hidden sm:flex flex-col items-end bg-white/90 backdrop-blur-sm px-6 py-4 rounded-2xl shadow-lg">
                        <div class="flex items-center gap-2 mb-1">
                            <x-icon name="star-solid" class="w-6 h-6 text-yellow-400" />
                            <span class="text-3xl font-bold text-gray-900">{{ number_format($coffeeShop->rating_avg, 1) }}</span>
                        </div>
                        <p class="text-sm text-gray-600 font-medium">{{ $coffeeShop->rating_count }} ulasan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Mobile Rating -->
                @if($coffeeShop->rating_count > 0)
                    <div class="sm:hidden bg-white rounded-2xl shadow-soft p-4 flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Rating</span>
                        <div class="flex items-center gap-2">
                            <x-icon name="star-solid" class="w-5 h-5 text-yellow-400" />
                            <span class="text-2xl font-bold text-gray-900">{{ number_format($coffeeShop->rating_avg, 1) }}</span>
                            <span class="text-gray-600">/ 5</span>
                            <span class="text-sm text-gray-500">({{ $coffeeShop->rating_count }})</span>
                        </div>
                    </div>
                @endif

                <!-- Description -->
                <div class="bg-white rounded-2xl shadow-soft p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Tentang</h2>
                    @if($coffeeShop->description)
                        <p class="text-gray-700 leading-relaxed">{{ $coffeeShop->description }}</p>
                    @else
                        <p class="text-gray-500 italic">Belum ada deskripsi.</p>
                    @endif
                </div>

                <!-- Facilities -->
                @if($coffeeShop->facilities->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <x-icon name="sparkles" class="w-6 h-6 text-coffee-600" />
                            <h2 class="text-2xl font-bold text-gray-900">Fasilitas</h2>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($coffeeShop->facilities as $facility)
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl hover:bg-coffee-50 transition group">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-xl shadow-sm group-hover:shadow transition">
                                        {{ $facility->icon }}
                                    </div>
                                    <span class="font-medium text-gray-900 text-sm">{{ $facility->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Menus -->
                @if($coffeeShop->menus->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-soft p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <x-icon name="menu" class="w-6 h-6 text-coffee-600" />
                            <h2 class="text-2xl font-bold text-gray-900">Menu</h2>
                        </div>
                        <div class="space-y-3">
                            @foreach($coffeeShop->menus->where('is_available', true)->take(10) as $menu)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-coffee-50 transition">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">{{ $menu->name }}</h4>
                                        @if($menu->description)
                                            <p class="text-sm text-gray-600 mt-1">{{ $menu->description }}</p>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <span class="text-lg font-bold text-coffee-600">Rp {{ number_format($menu->price) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Promotions -->
                @if($coffeeShop->promotions->isNotEmpty())
                    <div class="bg-gradient-to-br from-primary-50 to-coffee-50 rounded-2xl shadow-soft p-6 border-2 border-coffee-200">
                        <div class="flex items-center gap-2 mb-4">
                            <x-icon name="sparkles" class="w-6 h-6 text-coffee-600" />
                            <h2 class="text-2xl font-bold text-gray-900">Promosi Aktif</h2>
                        </div>
                        <div class="space-y-3">
                            @foreach($coffeeShop->promotions as $promo)
                                <div class="bg-white rounded-xl p-5 shadow-sm">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1">
                                            <h4 class="font-bold text-gray-900 text-lg">{{ $promo->title }}</h4>
                                            <p class="text-gray-600 mt-2">{{ $promo->description }}</p>
                                            <div class="flex items-center gap-2 mt-3 text-sm text-gray-500">
                                                <x-icon name="calendar" class="w-4 h-4" />
                                                <span>Valid hingga {{ $promo->valid_until->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="bg-gradient-to-br from-coffee-500 to-coffee-600 text-white px-4 py-2 rounded-xl font-bold text-xl shadow-lg">
                                            {{ $promo->discount_percentage }}%
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Reviews -->
                <div class="bg-white rounded-2xl shadow-soft p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2">
                            <x-icon name="star" class="w-6 h-6 text-yellow-500" />
                            <h2 class="text-2xl font-bold text-gray-900">
                                Ulasan <span class="text-coffee-600">({{ $coffeeShop->reviews->count() }})</span>
                            </h2>
                        </div>
                    </div>

                    @forelse($coffeeShop->reviews->take(5) as $review)
                        <div class="border-b border-gray-100 last:border-0 py-5 first:pt-0 last:pb-0">
                            <div class="flex items-start gap-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=random&bold=true" 
                                     class="w-12 h-12 rounded-full shadow-sm" alt="{{ $review->user->name }}">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $review->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <x-icon 
                                                    :name="$i <= $review->rating ? 'star-solid' : 'star'" 
                                                    class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" />
                                            @endfor
                                        </div>
                                    </div>
                                    @if($review->comment)
                                        <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <x-icon name="star" class="w-8 h-8 text-gray-400" />
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada ulasan</p>
                            <p class="text-sm text-gray-400 mt-1">Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-soft p-6 sticky top-20 space-y-6">
                    <!-- Price -->
                    <div class="pb-6 border-b">
                        <div class="flex items-center gap-2 mb-2">
                            <x-icon name="currency" class="w-5 h-5 text-coffee-600" />
                            <h3 class="text-sm font-semibold text-gray-600">Kisaran Harga</h3>
                        </div>
                        <p class="text-2xl font-bold text-coffee-600">
                            Rp {{ number_format($coffeeShop->price_min) }} - {{ number_format($coffeeShop->price_max) }}
                        </p>
                    </div>

                    <!-- Location -->
                    <div class="pb-6 border-b">
                        <div class="flex items-center gap-2 mb-3">
                            <x-icon name="location" class="w-5 h-5 text-coffee-600" />
                            <h3 class="text-sm font-semibold text-gray-600">Alamat</h3>
                        </div>
                        <p class="text-gray-900 font-medium">{{ $coffeeShop->address }}</p>
                        <p class="text-gray-600 text-sm mt-1">{{ $coffeeShop->area }}, {{ $coffeeShop->city }}</p>
                        
                        <!-- Map Link -->
                        <a href="https://www.google.com/maps?q={{ $coffeeShop->latitude }},{{ $coffeeShop->longitude }}" 
                           target="_blank"
                           class="mt-3 flex items-center justify-center gap-2 w-full px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium text-gray-700 transition">
                            <x-icon name="map-pin" class="w-4 h-4" />
                            <span>Buka di Google Maps</span>
                        </a>
                    </div>

                    <!-- Contact -->
                    @if($coffeeShop->phone || $coffeeShop->email)
                        <div class="pb-6 border-b">
                            <div class="flex items-center gap-2 mb-3">
                                <x-icon name="phone" class="w-5 h-5 text-coffee-600" />
                                <h3 class="text-sm font-semibold text-gray-600">Kontak</h3>
                            </div>
                            <div class="space-y-2">
                                @if($coffeeShop->phone)
                                    <a href="tel:{{ $coffeeShop->phone }}" class="flex items-center gap-2 text-gray-900 hover:text-coffee-600 transition">
                                        <x-icon name="phone" class="w-4 h-4" />
                                        <span class="text-sm font-medium">{{ $coffeeShop->phone }}</span>
                                    </a>
                                @endif
                                @if($coffeeShop->email)
                                    <a href="mailto:{{ $coffeeShop->email }}" class="flex items-center gap-2 text-gray-900 hover:text-coffee-600 transition">
                                        <x-icon name="envelope" class="w-4 h-4" />
                                        <span class="text-sm font-medium">{{ $coffeeShop->email }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="space-y-3" x-data="favoriteButton({{ $isFavorited ? 'true' : 'false' }}, {{ $coffeeShop->id }})">
                        @auth
                            <button @click="toggleFavorite()" 
                                :disabled="loading"
                                :class="isFavorited ? 'bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700' : 'bg-gradient-to-r from-coffee-600 to-coffee-700 hover:from-coffee-700 hover:to-coffee-800'"
                                class="w-full flex items-center justify-center gap-2 text-white py-3 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl disabled:opacity-50">
                                <span x-show="!loading" class="flex items-center gap-2">
                                    <x-icon :name="$isFavorited ? 'heart-solid' : 'heart'" class="w-5 h-5" />
                                    <span x-text="isFavorited ? 'Favorit' : 'Tambah ke Favorit'"></span>
                                </span>
                                <span x-show="loading" class="flex items-center gap-2">
                                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Memproses...</span>
                                </span>
                            </button>
                            
                            @php
                                $userReview = auth()->user()->reviews()->where('coffee_shop_id', $coffeeShop->id)->first();
                            @endphp
                            
                            @if($userReview)
                                <a href="{{ route('reviews.edit', $userReview) }}" 
                                   class="flex items-center justify-center gap-2 w-full border-2 border-coffee-600 text-coffee-600 py-3 rounded-xl font-semibold hover:bg-coffee-50 transition">
                                    <x-icon name="edit" class="w-5 h-5" />
                                    <span>Edit Ulasan Anda</span>
                                </a>
                            @else
                                <a href="{{ route('reviews.create', $coffeeShop) }}" 
                                   class="flex items-center justify-center gap-2 w-full border-2 border-coffee-600 text-coffee-600 py-3 rounded-xl font-semibold hover:bg-coffee-50 transition">
                                    <x-icon name="star" class="w-5 h-5" />
                                    <span>Tulis Ulasan</span>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full bg-gradient-to-r from-coffee-600 to-coffee-700 text-white py-3 rounded-xl font-semibold hover:from-coffee-700 hover:to-coffee-800 transition-all shadow-lg hover:shadow-xl">
                                <x-icon name="user" class="w-5 h-5" />
                                <span>Login untuk Favorit & Review</span>
                            </a>
                        @endauth
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 pt-6 border-t">
                        <div class="text-center p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center justify-center gap-1 mb-1">
                                <x-icon name="eye" class="w-4 h-4 text-coffee-600" />
                            </div>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($coffeeShop->view_count) }}</p>
                            <p class="text-xs text-gray-500 font-medium">Views</p>
                        </div>
                        <div class="text-center p-3 bg-gray-50 rounded-xl">
                            <div class="flex items-center justify-center gap-1 mb-1">
                                <x-icon name="heart" class="w-4 h-4 text-red-500" />
                            </div>
                            <p class="text-2xl font-bold text-gray-900">{{ $coffeeShop->favorites_count ?? 0 }}</p>
                            <p class="text-xs text-gray-500 font-medium">Favorites</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
