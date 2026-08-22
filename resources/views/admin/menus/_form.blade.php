<div class="space-y-6">
    <!-- Name -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Menu *</label>
        <input type="text" name="name" value="{{ old('name', $menu->name ?? '') }}" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('name') border-red-500 @enderror">
        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Category -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
        <select name="category" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('category') border-red-500 @enderror">
            <option value="">Pilih Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ old('category', $menu->category ?? '') == $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>
        @error('category')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
        <textarea name="description" rows="3"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('description') border-red-500 @enderror">{{ old('description', $menu->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Price -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) *</label>
        <input type="number" name="price" value="{{ old('price', $menu->price ?? '') }}" required min="0"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('price') border-red-500 @enderror">
        @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Available Status -->
    <div>
        <label class="flex items-center">
            <input type="checkbox" name="is_available" value="1" 
                {{ old('is_available', $menu->is_available ?? true) ? 'checked' : '' }}
                class="rounded border-gray-300 text-coffee-600 focus:ring-coffee-500">
            <span class="ml-2 text-sm font-medium text-gray-700">Tersedia (tampilkan di menu)</span>
        </label>
    </div>
</div>
