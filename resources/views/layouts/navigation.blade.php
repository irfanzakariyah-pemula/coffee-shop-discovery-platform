<nav class="bg-white/80 backdrop-blur-lg shadow-sm sticky top-0 z-50 border-b border-gray-100" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-coffee-600 via-coffee-700 to-coffee-800 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all group-hover:scale-105">
                        <x-icon name="coffee" class="w-6 h-6 text-white" />
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-coffee-700 via-coffee-800 to-coffee-900 bg-clip-text text-transparent">Ngopikel</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-gray-700 hover:text-coffee-600 px-4 py-2 rounded-xl hover:bg-coffee-50 transition font-medium">
                    <x-icon name="home" class="w-5 h-5" />
                    <span>Beranda</span>
                </a>
                <a href="{{ url('/coffee-shops') }}" class="flex items-center gap-2 text-gray-700 hover:text-coffee-600 px-4 py-2 rounded-xl hover:bg-coffee-50 transition font-medium">
                    <x-icon name="store" class="w-5 h-5" />
                    <span>Jelajah</span>
                </a>
                <a href="{{ url('/map') }}" class="flex items-center gap-2 text-gray-700 hover:text-coffee-600 px-4 py-2 rounded-xl hover:bg-coffee-50 transition font-medium">
                    <x-icon name="map" class="w-5 h-5" />
                    <span>Peta</span>
                </a>
                
                <!-- Auth Links -->
                @auth
                    <a href="{{ url('/favorites') }}" class="flex items-center gap-2 text-gray-700 hover:text-red-600 px-4 py-2 rounded-xl hover:bg-red-50 transition font-medium relative">
                        <x-icon name="heart" class="w-5 h-5" />
                        <span>Favorit</span>
                    </a>
                    
                    <div class="relative ml-2" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-coffee-600 rounded-xl hover:bg-coffee-50 transition">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=a8724a&color=fff&bold=true" 
                                 alt="Profile" 
                                 class="w-8 h-8 rounded-full shadow-sm ring-2 ring-white">
                            <span class="text-sm font-semibold max-w-24 truncate">{{ auth()->user()->name }}</span>
                            <x-icon name="chevron-down" class="w-4 h-4" />
                        </button>
                        
                        <!-- Dropdown -->
                        <div x-show="profileOpen" 
                             @click.away="profileOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-soft-lg py-2 border border-gray-100">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <x-icon name="user" class="w-4 h-4 text-gray-400" />
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ url('/my-reviews') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                <x-icon name="star" class="w-4 h-4 text-gray-400" />
                                <span>Ulasan Saya</span>
                            </a>
                            @if(auth()->user()->isAdmin())
                                <hr class="my-2">
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-coffee-600 hover:bg-coffee-50 transition font-medium">
                                    <x-icon name="chart" class="w-4 h-4" />
                                    <span>Admin Dashboard</span>
                                </a>
                            @endif
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                    <x-icon name="logout" class="w-4 h-4" />
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 text-gray-700 hover:text-coffee-600 px-4 py-2 rounded-xl hover:bg-coffee-50 transition font-medium">
                        <x-icon name="user" class="w-5 h-5" />
                        <span>Masuk</span>
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center gap-2 bg-gradient-to-r from-coffee-600 to-coffee-700 text-white px-5 py-2.5 rounded-xl font-semibold hover:from-coffee-700 hover:to-coffee-800 transition-all shadow-lg hover:shadow-xl">
                        <x-icon name="sparkles" class="w-5 h-5" />
                        <span>Daftar Gratis</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-gray-700 hover:text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                    <x-icon name="menu" x-show="!mobileMenuOpen" class="w-6 h-6" />
                    <x-icon name="x" x-show="mobileMenuOpen" class="w-6 h-6" />
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="md:hidden bg-white border-t border-gray-100">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                <x-icon name="home" class="w-5 h-5" />
                <span>Beranda</span>
            </a>
            <a href="{{ url('/coffee-shops') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                <x-icon name="store" class="w-5 h-5" />
                <span>Jelajah</span>
            </a>
            <a href="{{ url('/map') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                <x-icon name="map" class="w-5 h-5" />
                <span>Peta</span>
            </a>
            @guest
                <div class="pt-2 mt-2 border-t border-gray-100">
                    <a href="{{ url('/login') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                        <x-icon name="user" class="w-5 h-5" />
                        <span>Masuk</span>
                    </a>
                    <a href="{{ url('/register') }}" class="flex items-center justify-center gap-2 mt-2 px-4 py-3 text-base font-semibold text-white bg-gradient-to-r from-coffee-600 to-coffee-700 hover:from-coffee-700 hover:to-coffee-800 rounded-xl transition-all shadow-lg">
                        <x-icon name="sparkles" class="w-5 h-5" />
                        <span>Daftar Gratis</span>
                    </a>
                </div>
            @else
                <a href="{{ url('/favorites') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                    <x-icon name="heart" class="w-5 h-5" />
                    <span>Favorit</span>
                </a>
                <div class="pt-2 mt-2 border-t border-gray-100">
                    <div class="flex items-center gap-3 px-4 py-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=a8724a&color=fff&bold=true" 
                             alt="Profile" 
                             class="w-10 h-10 rounded-full shadow-sm ring-2 ring-white">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                        <x-icon name="user" class="w-5 h-5" />
                        <span>Profil Saya</span>
                    </a>
                    <a href="{{ url('/my-reviews') }}" class="flex items-center gap-3 px-4 py-3 text-base font-medium text-gray-700 hover:text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                        <x-icon name="star" class="w-5 h-5" />
                        <span>Ulasan Saya</span>
                    </a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-base font-semibold text-coffee-600 hover:bg-coffee-50 rounded-xl transition">
                            <x-icon name="chart" class="w-5 h-5" />
                            <span>Admin Dashboard</span>
                        </a>
                    @endif
                    <form method="POST" action="{{ url('/logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-base font-medium text-red-600 hover:bg-red-50 rounded-xl transition">
                            <x-icon name="logout" class="w-5 h-5" />
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            @endguest
        </div>
    </div>
</nav>
