@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="mt-2 text-gray-600">Selamat datang, {{ auth()->user()->name }}!</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Coffee Shops</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_coffee_shops'] }}</p>
                        <p class="text-xs text-green-600 mt-1">{{ $stats['active_coffee_shops'] }} aktif</p>
                    </div>
                    <div class="bg-coffee-100 p-3 rounded-full">☕</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Users</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Registered users</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">👥</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Reviews</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_reviews'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">Avg: ⭐ {{ $stats['avg_rating'] }}</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">⭐</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Favorites</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_favorites'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">User favorites</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">❤️</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Popular Coffee Shops -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">🔥 Popular Coffee Shops</h2>
                </div>
                <div class="p-6">
                    @forelse($popular_shops as $shop)
                        <div class="flex items-center justify-between py-3 border-b last:border-0">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-coffee-200 to-coffee-400 rounded-lg"></div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $shop->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $shop->city }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-coffee-600">{{ $shop->reviews_count }} reviews</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data</p>
                    @endforelse
                </div>
            </div>

            <!-- Top Reviewers -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">🏆 Top Reviewers</h2>
                </div>
                <div class="p-6">
                    @forelse($top_reviewers as $reviewer)
                        <div class="flex items-center justify-between py-3 border-b last:border-0">
                            <div class="flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($reviewer->name) }}&background=random" 
                                     class="w-10 h-10 rounded-full" alt="{{ $reviewer->name }}">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $reviewer->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $reviewer->email }}</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-yellow-600">{{ $reviewer->reviews_count }} reviews</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">⚡ Quick Actions</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.coffee-shops.create') }}" 
                   class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-coffee-500 transition">
                    <div class="text-3xl mr-4">➕</div>
                    <div>
                        <p class="font-semibold text-gray-900">Add Coffee Shop</p>
                        <p class="text-sm text-gray-500">Create new</p>
                    </div>
                </a>

                <a href="{{ route('admin.coffee-shops.index') }}" 
                   class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-coffee-500 transition">
                    <div class="text-3xl mr-4">📋</div>
                    <div>
                        <p class="font-semibold text-gray-900">Manage Shops</p>
                        <p class="text-sm text-gray-500">Edit or delete</p>
                    </div>
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-coffee-500 transition">
                    <div class="text-3xl mr-4">👥</div>
                    <div>
                        <p class="font-semibold text-gray-900">Manage Users</p>
                        <p class="text-sm text-gray-500">View all users</p>
                    </div>
                </a>

                <a href="{{ route('coffee-shops.index') }}" target="_blank"
                   class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-coffee-500 transition">
                    <div class="text-3xl mr-4">🌐</div>
                    <div>
                        <p class="font-semibold text-gray-900">View Site</p>
                        <p class="text-sm text-gray-500">Public view</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Reviews -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">💬 Recent Reviews</h2>
                </div>
                <div class="p-6">
                    @forelse($recent_reviews as $review)
                        <div class="py-3 border-b last:border-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">{{ $review->user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $review->coffeeShop->name }}</p>
                                    @if($review->comment)
                                        <p class="text-sm text-gray-700 mt-1 line-clamp-2">{{ $review->comment }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center ml-3">
                                    @for($i = 1; $i <= $review->rating; $i++)
                                        ⭐
                                    @endfor
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada review</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">👤 Recent Users</h2>
                </div>
                <div class="p-6">
                    @forelse($recent_users as $user)
                        <div class="flex items-center justify-between py-3 border-b last:border-0">
                            <div class="flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" 
                                     class="w-10 h-10 rounded-full" alt="{{ $user->name }}">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada user baru</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
