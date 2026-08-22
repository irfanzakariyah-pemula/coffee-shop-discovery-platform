@extends('layouts.app')

@section('title', 'Kelola Coffee Shop')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Coffee Shop</h1>
                <p class="text-gray-600 mt-1">Total: {{ $coffeeShops->total() }} coffee shop</p>
            </div>
            <a href="{{ route('admin.coffee-shops.create') }}" class="bg-coffee-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-coffee-700 transition">
                ➕ Tambah Coffee Shop
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Coffee Shop</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($coffeeShops as $shop)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-coffee-200 to-coffee-400 rounded-lg flex-shrink-0"></div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $shop->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $shop->area }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $shop->category->name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $shop->city }}
                            </td>
                            <td class="px-6 py-4">
                                @if($shop->rating_count > 0)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="text-sm font-semibold">{{ number_format($shop->rating_avg, 1) }}</span>
                                        <span class="text-xs text-gray-500 ml-1">({{ $shop->rating_count }})</span>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">Belum ada rating</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($shop->is_active)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                <a href="{{ route('coffee-shops.show', $shop->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-900">Lihat</a>
                                <a href="{{ route('admin.coffee-shops.edit', $shop) }}" class="text-coffee-600 hover:text-coffee-900">Edit</a>
                                <form action="{{ route('admin.coffee-shops.destroy', $shop) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus {{ $shop->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                Belum ada coffee shop. <a href="{{ route('admin.coffee-shops.create') }}" class="text-coffee-600 hover:text-coffee-700 font-semibold">Tambah sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $coffeeShops->links() }}
        </div>
    </div>
</div>
@endsection
