@extends('layouts.app')

@section('title', 'Kelola Promo - ' . $coffeeShop->name)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.coffee-shops.index') }}" class="text-coffee-600 hover:text-coffee-700 mb-2 inline-block">
                    ← Kembali ke Daftar Coffee Shop
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Promo: {{ $coffeeShop->name }}</h1>
                <p class="text-gray-600 mt-1">Total: {{ $promotions->total() }} promo</p>
            </div>
            <a href="{{ route('admin.coffee-shops.promotions.create', $coffeeShop) }}" 
               class="bg-coffee-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-coffee-700 transition">
                ➕ Tambah Promo
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($promotions as $promo)
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $promo->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $promo->description }}</p>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <a href="{{ route('admin.coffee-shops.promotions.edit', [$coffeeShop, $promo]) }}" 
                               class="text-coffee-600 hover:text-coffee-700 text-sm font-medium">Edit</a>
                            <form action="{{ route('admin.coffee-shops.promotions.destroy', [$coffeeShop, $promo]) }}" 
                                  method="POST" onsubmit="return confirm('Yakin ingin menghapus promo ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">Hapus</button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-gray-500">Diskon</p>
                            <p class="text-lg font-bold text-coffee-600">{{ $promo->discount_text }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Min. Pembelian</p>
                            <p class="text-sm font-semibold">{{ $promo->min_purchase ? 'Rp ' . number_format($promo->min_purchase) : '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm border-t pt-4">
                        <span class="text-gray-600">
                            {{ $promo->start_date->format('d M Y') }} - {{ $promo->end_date->format('d M Y') }}
                        </span>
                        @if($promo->isCurrentlyActive())
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                        @elseif($promo->start_date > now())
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Akan Datang</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Berakhir</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-2 bg-white rounded-lg shadow p-12 text-center">
                    <p class="text-gray-500">Belum ada promo. 
                        <a href="{{ route('admin.coffee-shops.promotions.create', $coffeeShop) }}" 
                           class="text-coffee-600 hover:text-coffee-700 font-semibold">Tambah sekarang</a>
                    </p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">{{ $promotions->links() }}</div>
    </div>
</div>
@endsection
