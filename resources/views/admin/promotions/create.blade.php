@extends('layouts.app')
@section('title', 'Tambah Promo')
@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('admin.coffee-shops.promotions.index', $coffeeShop) }}" class="text-coffee-600 hover:text-coffee-700 mb-4 inline-block">← Kembali</a>
            <h1 class="text-3xl font-bold text-gray-900">Tambah Promo</h1>
            <p class="text-gray-600 mt-1">{{ $coffeeShop->name }}</p>
        </div>
        <form action="{{ route('admin.coffee-shops.promotions.store', $coffeeShop) }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf
            @include('admin.promotions._form')
            <div class="flex items-center justify-end space-x-4 pt-6 mt-6 border-t">
                <a href="{{ route('admin.coffee-shops.promotions.index', $coffeeShop) }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="px-6 py-2 bg-coffee-600 text-white rounded-lg font-semibold hover:bg-coffee-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
