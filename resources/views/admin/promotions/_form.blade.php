<div class="space-y-6">
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Promo *</label>
            <input type="text" name="title" value="{{ old('title', $promotion->title ?? '') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('title') border-red-500 @enderror">
            @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" rows="2"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">{{ old('description', $promotion->description ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Diskon *</label>
            <select name="discount_type" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
                @foreach($discountTypes as $key => $label)
                    <option value="{{ $key }}" {{ old('discount_type', $promotion->discount_type ?? '') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nilai Diskon *</label>
            <input type="number" name="discount_value" value="{{ old('discount_value', $promotion->discount_value ?? '') }}" required min="1"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
            <input type="date" name="start_date" value="{{ old('start_date', $promotion->start_date?->format('Y-m-d') ?? '') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir *</label>
            <input type="date" name="end_date" value="{{ old('end_date', $promotion->end_date?->format('Y-m-d') ?? '') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Min. Pembelian (Rp)</label>
            <input type="number" name="min_purchase" value="{{ old('min_purchase', $promotion->min_purchase ?? '') }}" min="0"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
        </div>

        <div class="col-span-2">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" 
                    {{ old('is_active', $promotion->is_active ?? true) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-coffee-600 focus:ring-coffee-500">
                <span class="ml-2 text-sm font-medium text-gray-700">Aktif</span>
            </label>
        </div>
    </div>
</div>
