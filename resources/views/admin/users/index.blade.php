@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Kelola User</h1>
            <p class="text-gray-600 mt-1">Total: {{ $users->total() }} users</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">{{ session('error') }}</div>
        @endif

        <!-- Search & Filter -->
        <form method="GET" class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
                <select name="role" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
                    <option value="">Semua Role</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                <button type="submit" class="bg-coffee-600 text-white px-6 py-2 rounded-lg hover:bg-coffee-700 transition">
                    🔍 Cari
                </button>
            </div>
        </form>

        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stats</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" 
                                         class="w-10 h-10 rounded-full" alt="{{ $user->name }}">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->isAdmin())
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Admin</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                ⭐ {{ $user->reviews_count }} | ❤️ {{ $user->favorites_count }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.toggle-role', $user) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-purple-600 hover:text-purple-900">
                                            {{ $user->isAdmin() ? 'Make User' : 'Make Admin' }}
                                        </button>
                                    </form>
                                    @if(!$user->isAdmin())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">Tidak ada user ditemukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $users->links() }}</div>
    </div>
</div>
@endsection
