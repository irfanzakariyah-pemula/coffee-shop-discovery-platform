@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div>
            <div class="flex justify-center">
                <svg class="w-16 h-16 text-coffee-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M2 21h19v-3H2v3zM20 8H4V6h16v2zM3 12v2c0 1.656 1.344 3 3 3h12c1.656 0 3-1.344 3-3v-2H3zm0-3h18V7H3v2z"/>
                </svg>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                Masuk ke Akun Anda
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Atau
                <a href="{{ route('register') }}" class="font-medium text-coffee-600 hover:text-coffee-700">
                    daftar akun baru gratis
                </a>
            </p>
        </div>

        <!-- Form -->
        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        autofocus
                        value="{{ old('email') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-coffee-500 focus:border-coffee-500 @error('email') border-red-500 @enderror"
                        placeholder="john@example.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-coffee-600 hover:text-coffee-700">
                                Lupa password?
                            </a>
                        </div>
                    </div>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-coffee-500 focus:border-coffee-500 @error('password') border-red-500 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input 
                        id="remember" 
                        name="remember" 
                        type="checkbox" 
                        class="h-4 w-4 text-coffee-600 focus:ring-coffee-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Ingat saya
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-coffee-600 hover:bg-coffee-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-coffee-500 transition">
                    Masuk
                </button>
            </div>

            <!-- Demo Accounts -->
            <div class="mt-6 border-t border-gray-200 pt-6">
                <p class="text-xs text-center text-gray-500 mb-3">Demo Akun (untuk testing):</p>
                <div class="space-y-2 text-xs">
                    <div class="bg-blue-50 p-2 rounded">
                        <strong>Admin:</strong> admin@ngopikel.com / password
                    </div>
                    <div class="bg-green-50 p-2 rounded">
                        <strong>User:</strong> user@example.com / password
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
