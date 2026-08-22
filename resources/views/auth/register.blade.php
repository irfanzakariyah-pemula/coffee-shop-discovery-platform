@extends('layouts.app')

@section('title', 'Daftar Akun')

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
                Daftar Akun Baru
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Atau
                <a href="{{ route('login') }}" class="font-medium text-coffee-600 hover:text-coffee-700">
                    masuk ke akun yang sudah ada
                </a>
            </p>
        </div>

        <!-- Form -->
        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama Lengkap
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        required 
                        value="{{ old('name') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-coffee-500 focus:border-coffee-500 @error('name') border-red-500 @enderror"
                        placeholder="John Doe">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

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
                        value="{{ old('email') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-coffee-500 focus:border-coffee-500 @error('email') border-red-500 @enderror"
                        placeholder="john@example.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
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

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Konfirmasi Password
                    </label>
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-coffee-500 focus:border-coffee-500"
                        placeholder="••••••••">
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button 
                    type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-coffee-600 hover:bg-coffee-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-coffee-500 transition">
                    Daftar Sekarang
                </button>
            </div>

            <!-- Terms -->
            <p class="text-center text-xs text-gray-500">
                Dengan mendaftar, Anda menyetujui 
                <a href="#" class="text-coffee-600 hover:text-coffee-700">Syarat & Ketentuan</a> 
                dan 
                <a href="#" class="text-coffee-600 hover:text-coffee-700">Kebijakan Privasi</a>
            </p>
        </form>
    </div>
</div>
@endsection
