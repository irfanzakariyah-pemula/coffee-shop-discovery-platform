@extends('layouts.app')

@section('title', 'Favorit Saya')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">❤️ Favorit Saya</h1>
            <p class="mt-2 text-gray-600">
                {{ $favorites->total() }} coffee shop yang Anda sukai
            </p>
        </div>

        @if($favorites->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada favorit</h3>
                <p class="text-gray-600 mb-6">Mulai tambahkan coffee shop favorit Anda!</p>
                <a href="{{ route('coffee-shops.index') }}" class="inline-block bg-coffee-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-coffee-700 transition">
                    Jelajah Coffee Shop
                </a>
            </div>
        @else
            <!-- Favorites Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($favorites as $shop)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden group" 
                         x-data="{ removing: false }">
                        <!-- Image -->
                        <div class="h-48 bg-gradient-to-br from-coffee-200 to-coffee-300 relative overflow-hidden">
                            <div class="absolute inset-0 bg-coffee-900 bg-opacity-0 group-hover:bg-opacity-10 transition"></div>
                            
                            <!-- Remove Favorite Button -->
                            <button @click="removing = !removing" 
                                class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition z-10">
                                <span x-show="!removing" class="text-red-500 text-xl">❤️</span>
                                <span x-show="removing" class="text-gray-400 text-xl">🤍</span>
                            </button>

                            <!-- Remove Confirmation -->
                            <div x-show="removing" 
                                 x-transition
                                 class="absolute inset-0 bg-black bg-opacity-80 flex items-center justify-center p-4">
                                <div class="text-center">
                                    <p class="text-white text-sm mb-3">Hapus dari favorit?</p>
                                    <div class="flex space-x-2">
                                        <form action="{{ route('favorites.destroy', $shop) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                                Ya, Hapus
                                            </button>
                                        </form>
                                        <button @click="removing = false" class="px-4 py-2 bg-gray-600 text-white text-sm rounded hover:bg-gray-700 transition">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <a href="{{ route('coffee-shops.show', $shop->slug) }}" class="block p-4">
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
                                    @foreach($shop->facilities->take(4) as $facility)
                                        <span class="text-xs">{{ $facility->icon }}</span>
                                    @endforeach
                                    @if($shop->facilities->count() > 4)
                                        <span class="text-xs text-gray-500">+{{ $shop->facilities->count() - 4 }}</span>
                                    @endif
                                </div>
                            @endif

                            <!-- Reviews Count -->
                            @if($shop->reviews_count > 0)
                                <div class="mt-3 pt-3 border-t text-xs text-gray-500">
                                    📝 {{ $shop->reviews_count }} ulasan
                                </div>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $favorites->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
