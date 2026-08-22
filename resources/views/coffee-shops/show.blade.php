@extends('layouts.app')

@section('title', $coffeeShop->name)

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ route('coffee-shops.index') }}" class="inline-flex items-center text-coffee-600 hover:text-coffee-700 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Hero Image -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="h-96 bg-gradient-to-br from-coffee-200 to-coffee-400"></div>
                </div>

                <!-- Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $coffeeShop->name }}</h1>
                            <p class="text-gray-600 mt-1">{{ $coffeeShop->category->name }}</p>
                        </div>
                        @if($coffeeShop->rating_count > 0)
                            <div class="text-right">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-2xl font-bold">{{ number_format($coffeeShop->rating_avg, 1) }}</span>
                                </div>
                                <p class="text-sm text-gray-500">{{ $coffeeShop->rating_count }} ulasan</p>
                            </div>
                        @endif
                    </div>

                    @if($coffeeShop->description)
                        <p class="text-gray-700 leading-relaxed">{{ $coffeeShop->description }}</p>
                    @endif
                </div>

                <!-- Facilities -->
                @if($coffeeShop->facilities->isNotEmpty())
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Fasilitas</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($coffeeShop->facilities as $facility)
                                <div class="flex items-center space-x-2 text-gray-700">
                                    <span class="text-2xl">{{ $facility->icon }}</span>
                                    <span>{{ $facility->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Reviews -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                        Ulasan ({{ $coffeeShop->reviews->count() }})
                    </h2>
                    @forelse($coffeeShop->reviews->take(5) as $review)
                        <div class="border-b border-gray-200 last:border-0 py-4 first:pt-0 last:pb-0">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center space-x-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=random" 
                                         class="w-10 h-10 rounded-full" alt="{{ $review->user->name }}">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $review->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            @if($review->comment)
                                <p class="text-gray-700 text-sm">{{ $review->comment }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Belum ada ulasan</p>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-20 space-y-6">
                    <!-- Price -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Kisaran Harga</h3>
                        <p class="text-2xl font-bold text-coffee-600">
                            Rp {{ number_format($coffeeShop->price_min) }} - {{ number_format($coffeeShop->price_max) }}
                        </p>
                    </div>

                    <!-- Location -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Alamat</h3>
                        <p class="text-gray-900">{{ $coffeeShop->address }}</p>
                        <p class="text-gray-600 text-sm mt-1">{{ $coffeeShop->area }}, {{ $coffeeShop->city }}</p>
                    </div>

                    <!-- Contact -->
                    @if($coffeeShop->phone || $coffeeShop->email)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Kontak</h3>
                            @if($coffeeShop->phone)
                                <p class="text-gray-900 text-sm">📞 {{ $coffeeShop->phone }}</p>
                            @endif
                            @if($coffeeShop->email)
                                <p class="text-gray-900 text-sm mt-1">✉️ {{ $coffeeShop->email }}</p>
                            @endif
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="space-y-3 pt-4 border-t">
                        @auth
                            <button class="w-full bg-coffee-600 text-white py-3 rounded-lg font-semibold hover:bg-coffee-700 transition">
                                {{ $isFavorited ? '❤️ Favorit' : '🤍 Tambah ke Favorit' }}
                            </button>
                            <button class="w-full border-2 border-coffee-600 text-coffee-600 py-3 rounded-lg font-semibold hover:bg-coffee-50 transition">
                                ⭐ Tulis Ulasan
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-coffee-600 text-white py-3 rounded-lg font-semibold text-center hover:bg-coffee-700 transition">
                                Login untuk Favorit & Review
                            </a>
                        @endauth
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900">{{ $coffeeShop->view_count }}</p>
                            <p class="text-xs text-gray-500">Views</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900">{{ $coffeeShop->rating_count }}</p>
                            <p class="text-xs text-gray-500">Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
