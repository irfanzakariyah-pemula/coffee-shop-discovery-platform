<nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-coffee-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M2 21h19v-3H2v3zM20 8H4V6h16v2zM3 12v2c0 1.656 1.344 3 3 3h12c1.656 0 3-1.344 3-3v-2H3zm0-3h18V7H3v2z"/>
                    </svg>
                    <span class="text-2xl font-bold text-coffee-700">Ngopikel</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-coffee-600 px-3 py-2 text-sm font-medium">
                    Beranda
                </a>
                <a href="{{ url('/coffee-shops') }}" class="text-gray-700 hover:text-coffee-600 px-3 py-2 text-sm font-medium">
                    Jelajah
                </a>
                <a href="{{ url('/map') }}" class="text-gray-700 hover:text-coffee-600 px-3 py-2 text-sm font-medium">
                    Peta
                </a>
                
                <!-- Auth Links -->
                @guest
                    <a href="{{ url('/login') }}" class="text-gray-700 hover:text-coffee-600 px-3 py-2 text-sm font-medium">
                        Masuk
                    </a>
                    <a href="{{ url('/register') }}" class="bg-coffee-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-coffee-700 transition">
                        Daftar
                    </a>
                @else
                    <a href="{{ url('/favorites') }}" class="text-gray-700 hover:text-coffee-600 px-3 py-2 text-sm font-medium relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </a>
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-2 text-gray-700 hover:text-coffee-600">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=c97d3c&color=fff" 
                                 alt="Profile" 
                                 class="w-8 h-8 rounded-full">
                            <span class="text-sm font-medium">{{ auth()->user()->name ?? 'User' }}</span>
                        </button>
                        
                        <!-- Dropdown -->
                        <div x-show="profileOpen" 
                             @click.away="profileOpen = false"
                             x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-gray-200">
                            <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profil Saya
                            </a>
                            <a href="{{ url('/my-reviews') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Ulasan Saya
                            </a>
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <hr class="my-2">
                                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 text-sm text-coffee-600 hover:bg-gray-100">
                                    Admin Dashboard
                                </a>
                            @endif
                            <hr class="my-2">
                            <form method="POST" action="{{ url('/logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-coffee-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition
         class="md:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-gray-50 rounded-md">
                Beranda
            </a>
            <a href="{{ url('/coffee-shops') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-gray-50 rounded-md">
                Jelajah
            </a>
            <a href="{{ url('/map') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-gray-50 rounded-md">
                Peta
            </a>
            @guest
                <a href="{{ url('/login') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-gray-50 rounded-md">
                    Masuk
                </a>
                <a href="{{ url('/register') }}" class="block px-3 py-2 text-base font-medium text-white bg-coffee-600 hover:bg-coffee-700 rounded-md">
                    Daftar
                </a>
            @else
                <a href="{{ url('/favorites') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-gray-50 rounded-md">
                    Favorit
                </a>
                <a href="{{ url('/profile') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-gray-50 rounded-md">
                    Profil Saya
                </a>
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-red-600 hover:bg-gray-50 rounded-md">
                        Keluar
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>
