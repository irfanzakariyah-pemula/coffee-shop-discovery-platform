@extends('layouts.app')

@section('title', 'Edit Coffee Shop')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.coffee-shops.index') }}" class="text-coffee-600 hover:text-coffee-700 mb-4 inline-block">
                ← Kembali ke Daftar
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Edit Coffee Shop</h1>
            <p class="text-gray-600 mt-1">{{ $coffeeShop->name }}</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.coffee-shops.update', $coffeeShop) }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Coffee Shop *</label>
                <input type="text" name="name" value="{{ old('name', $coffeeShop->name) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                <select name="category_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('category_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $coffeeShop->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('description') border-red-500 @enderror">{{ old('description', $coffeeShop->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                <textarea name="address" rows="2" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('address') border-red-500 @enderror">{{ old('address', $coffeeShop->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- City & Area -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                    <input type="text" name="city" value="{{ old('city', $coffeeShop->city) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('city') border-red-500 @enderror">
                    @error('city')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                    <input type="text" name="area" value="{{ old('area', $coffeeShop->area) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('area') border-red-500 @enderror">
                    @error('area')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Coordinates -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Latitude *</label>
                    <input type="number" step="any" name="latitude" value="{{ old('latitude', $coffeeShop->latitude) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('latitude') border-red-500 @enderror">
                    @error('latitude')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Longitude *</label>
                    <input type="number" step="any" name="longitude" value="{{ old('longitude', $coffeeShop->longitude) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('longitude') border-red-500 @enderror">
                    @error('longitude')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Contact -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $coffeeShop->phone) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $coffeeShop->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Price Range -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Minimum (Rp) *</label>
                    <input type="number" name="price_min" value="{{ old('price_min', $coffeeShop->price_min) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('price_min') border-red-500 @enderror">
                    @error('price_min')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Maksimum (Rp) *</label>
                    <input type="number" name="price_max" value="{{ old('price_max', $coffeeShop->price_max) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('price_max') border-red-500 @enderror">
                    @error('price_max')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Facilities -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($facilities as $facility)
                        <label class="flex items-center">
                            <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                {{ in_array($facility->id, old('facilities', $coffeeShop->facilities->pluck('id')->toArray())) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-coffee-600 focus:ring-coffee-500">
                            <span class="ml-2 text-sm text-gray-700">{{ $facility->icon }} {{ $facility->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Active Status -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $coffeeShop->is_active) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-coffee-600 focus:ring-coffee-500">
                    <span class="ml-2 text-sm font-medium text-gray-700">Aktif (tampilkan di website)</span>
                </label>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t">
                <a href="{{ route('admin.coffee-shops.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-coffee-600 text-white rounded-lg font-semibold hover:bg-coffee-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
