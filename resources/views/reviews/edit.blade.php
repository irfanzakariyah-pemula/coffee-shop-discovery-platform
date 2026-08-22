@extends('layouts.app')

@section('title', 'Edit Ulasan')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('coffee-shops.show', $review->coffeeShop->slug) }}" class="text-coffee-600 hover:text-coffee-700 mb-4 inline-block">
                ← Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Edit Ulasan</h1>
            <p class="text-gray-600 mt-2">Perbarui ulasan Anda untuk {{ $review->coffeeShop->name }}</p>
        </div>

        <!-- Coffee Shop Info -->
        <div class="bg-white rounded-lg shadow p-4 mb-6 flex items-center space-x-4">
            <div class="w-20 h-20 bg-gradient-to-br from-coffee-200 to-coffee-400 rounded-lg flex-shrink-0"></div>
            <div>
                <h3 class="font-semibold text-gray-900">{{ $review->coffeeShop->name }}</h3>
                <p class="text-sm text-gray-600">{{ $review->coffeeShop->area }}, {{ $review->coffeeShop->city }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $review->coffeeShop->category->name }}</p>
            </div>
        </div>

        <!-- Review Form -->
        <form action="{{ route('reviews.update', $review) }}" method="POST" 
              class="bg-white rounded-lg shadow p-6 space-y-6"
              x-data="reviewForm()">
            @csrf
            @method('PUT')

            <!-- Rating -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Rating *
                </label>
                <div class="flex items-center space-x-2">
                    <template x-for="star in 5" :key="star">
                        <button type="button" 
                            @click="rating = star"
                            class="focus:outline-none transition-transform hover:scale-110">
                            <svg :class="star <= rating ? 'text-yellow-400' : 'text-gray-300'" 
                                 class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </button>
                    </template>
                    <span class="ml-3 text-sm text-gray-600" x-text="ratingText"></span>
                </div>
                <input type="hidden" name="rating" :value="rating">
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Comment -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Komentar (opsional)
                </label>
                <textarea name="comment" rows="6" 
                    placeholder="Ceritakan pengalaman Anda..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500 @error('comment') border-red-500 @enderror"
                    x-model="comment"
                    maxlength="1000">{{ old('comment', $review->comment) }}</textarea>
                <div class="flex justify-between mt-1">
                    @error('comment')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @else
                        <p class="text-sm text-gray-500">Tuliskan minimal 10 karakter</p>
                    @enderror
                    <p class="text-sm text-gray-500" x-text="comment.length + '/1000'"></p>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-between pt-4 border-t">
                <form action="{{ route('reviews.destroy', $review) }}" method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                        🗑️ Hapus Ulasan
                    </button>
                </form>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('coffee-shops.show', $review->coffeeShop->slug) }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" 
                        :disabled="rating === 0"
                        :class="rating === 0 ? 'opacity-50 cursor-not-allowed' : ''"
                        class="px-6 py-2 bg-coffee-600 text-white rounded-lg font-semibold hover:bg-coffee-700 transition">
                        Perbarui Ulasan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function reviewForm() {
    return {
        rating: {{ old('rating', $review->rating) }},
        comment: `{{ old('comment', $review->comment) }}`,
        
        get ratingText() {
            const texts = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Bagus', 'Sangat Bagus'];
            return texts[this.rating] || '';
        }
    }
}
</script>
@endpush
@endsection
