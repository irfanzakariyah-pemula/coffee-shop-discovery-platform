@extends('layouts.app')

@section('title', 'User Detail - ' . $user->name)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('admin.users.index') }}" class="text-coffee-600 hover:text-coffee-700 mb-6 inline-block">← Back</a>

        <!-- User Info -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex items-start justify-between">
                <div class="flex items-center space-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=80" 
                         class="w-20 h-20 rounded-full" alt="{{ $user->name }}">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <p class="text-sm text-gray-500 mt-1">Joined: {{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                @if($user->isAdmin())
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">Admin</span>
                @else
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">User</span>
                @endif
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_reviews'] }}</p>
                <p class="text-sm text-gray-600">Reviews</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_favorites'] }}</p>
                <p class="text-sm text-gray-600">Favorites</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-3xl font-bold text-gray-900">{{ $stats['avg_rating_given'] ?: '-' }}</p>
                <p class="text-sm text-gray-600">Avg Rating Given</p>
            </div>
        </div>

        <!-- Reviews -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Reviews ({{ $user->reviews->count() }})</h2>
            @forelse($user->reviews as $review)
                <div class="py-3 border-b last:border-0">
                    <div class="flex items-start justify-between">
                        <div>
                            <a href="{{ route('coffee-shops.show', $review->coffeeShop->slug) }}" 
                               class="font-semibold text-coffee-600 hover:text-coffee-700">
                                {{ $review->coffeeShop->name }}
                            </a>
                            @if($review->comment)
                                <p class="text-sm text-gray-700 mt-1">{{ $review->comment }}</p>
                            @endif
                        </div>
                        <div class="flex items-center ml-3">
                            @for($i = 1; $i <= $review->rating; $i++) ⭐ @endfor
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">{{ $review->created_at->format('d M Y') }}</p>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">Belum ada review</p>
            @endforelse
        </div>

        <!-- Favorites -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Favorites ({{ $user->favoriteCoffeeShops->count() }})</h2>
            <div class="grid grid-cols-2 gap-4">
                @forelse($user->favoriteCoffeeShops as $shop)
                    <a href="{{ route('coffee-shops.show', $shop->slug) }}" 
                       class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:border-coffee-500 transition">
                        <div class="w-12 h-12 bg-gradient-to-br from-coffee-200 to-coffee-400 rounded-lg"></div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $shop->name }}</p>
                            <p class="text-sm text-gray-600">{{ $shop->city }}</p>
                        </div>
                    </a>
                @empty
                    <p class="col-span-2 text-gray-500 text-center py-4">Belum ada favorit</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
