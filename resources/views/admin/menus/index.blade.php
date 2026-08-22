@extends('layouts.app')

@section('title', 'Kelola Menu - ' . $coffeeShop->name)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.coffee-shops.index') }}" class="text-coffee-600 hover:text-coffee-700 mb-2 inline-block">
                    ← Kembali ke Daftar Coffee Shop
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Menu: {{ $coffeeShop->name }}</h1>
                <p class="text-gray-600 mt-1">Total: {{ $menus->total() }} menu</p>
            </div>
            <a href="{{ route('admin.coffee-shops.menus.create', $coffeeShop) }}" 
               class="bg-coffee-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-coffee-700 transition">
                ➕ Tambah Menu
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Menu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($menus as $menu)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $menu->name }}</div>
                                @if($menu->description)
                                    <div class="text-sm text-gray-500 line-clamp-1">{{ $menu->description }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $menu->category }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">Rp {{ number_format($menu->price) }}</td>
                            <td class="px-6 py-4">
                                @if($menu->is_available)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                <a href="{{ route('admin.coffee-shops.menus.edit', [$coffeeShop, $menu]) }}" 
                                   class="text-coffee-600 hover:text-coffee-900">Edit</a>
                                <form action="{{ route('admin.coffee-shops.menus.destroy', [$coffeeShop, $menu]) }}" 
                                      method="POST" class="inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Belum ada menu. <a href="{{ route('admin.coffee-shops.menus.create', $coffeeShop) }}" 
                                   class="text-coffee-600 hover:text-coffee-700 font-semibold">Tambah sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $menus->links() }}</div>
    </div>
</div>
@endsection
