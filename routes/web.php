<?php

use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CoffeeShopController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Coffee Shops (Public)
Route::get('/coffee-shops', [CoffeeShopController::class, 'index'])->name('coffee-shops.index');
Route::get('/coffee-shops/{slug}', [CoffeeShopController::class, 'show'])->name('coffee-shops.show');

// Map
Route::get('/map', [\App\Http\Controllers\MapPageController::class, 'index'])->name('map');

// Map API Routes
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/map/coffee-shops', [MapController::class, 'coffeeShops'])->name('map.coffee-shops');
    Route::post('/map/nearby', [MapController::class, 'nearby'])->name('map.nearby');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // Login
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Coffee Shops Management
    Route::resource('coffee-shops', \App\Http\Controllers\Admin\CoffeeShopController::class);
});
