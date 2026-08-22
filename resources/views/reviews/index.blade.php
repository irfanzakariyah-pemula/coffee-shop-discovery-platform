@extends('layouts.app')

@section('title', 'Ulasan Saya')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📝 Ulasan Saya</h1>
            <p class="mt-2 text-gray-600">
                {{ $reviews->total() }} ulasan yang pernah Anda tulis
            </p>
        </div>

        @if($reviews->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada ulasan</h3>
                <p class="text-gray-600 mb-6">Bagikan pengalaman Anda dengan menulis ulasan!</p>
                <a href="{{ route('coffee-shops.index') }}" class="inline-block bg-coffee-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-coffee-700 transition">
                    Jelajah Coffee Shop
                </a>
            </div>
        @else
            <!-- Reviews List -->
            <div class="space-y-4">
                @foreach($reviews as $review)
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
                        <!-- Coffee Shop Info -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-coffee-200 to-coffee-400 rounded-lg flex-shrink-0"></div>
                                <div>
                                    <a href="{{ route('coffee-shops.show', $review->coffeeShop->slug) }}" 
                                       class="font-semibold text-gray-900 hover:text-coffee-600 transition">
                                        {{ $review->coffeeShop->name }}
                                    </a>
                                    <p class="text-sm text-gray-600">{{ $review->coffeeShop->area }}, {{ $review->coffeeShop->city }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $review->coffeeShop->category->name }}</p>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('reviews.edit', $review) }}" 
                                   class="text-coffee-600 hover:text-coffee-700 text-sm font-medium">
                                    Edit
                                </a>
                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">{{ $review->created_at->format('d M Y') }}</span>
                            @if($review->created_at != $review->updated_at)
                                <span class="ml-2 text-xs text-gray-500">(diedit)</span>
                            @endif
                        </div>

                        <!-- Comment -->
                        @if($review->comment)
                            <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                        @else
                            <p class="text-gray-400 italic">Tidak ada komentar</p>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
