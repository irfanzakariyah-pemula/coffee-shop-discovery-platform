<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="col-span-1">
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="w-8 h-8 text-coffee-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M2 21h19v-3H2v3zM20 8H4V6h16v2zM3 12v2c0 1.656 1.344 3 3 3h12c1.656 0 3-1.344 3-3v-2H3zm0-3h18V7H3v2z"/>
                    </svg>
                    <span class="text-2xl font-bold">Ngopikel</span>
                </div>
                <p class="text-gray-400 text-sm">
                    Platform penemuan coffee shop terbaik berdasarkan lokasi, fasilitas, dan preferensi Anda.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Navigasi</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ url('/coffee-shops') }}" class="hover:text-white transition">Jelajah Coffee Shop</a></li>
                    <li><a href="{{ url('/map') }}" class="hover:text-white transition">Peta</a></li>
                    <li><a href="{{ url('/about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Kategori</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Cafe Modern</a></li>
                    <li><a href="#" class="hover:text-white transition">Coffee Shop Tradisional</a></li>
                    <li><a href="#" class="hover:text-white transition">Roastery</a></li>
                    <li><a href="#" class="hover:text-white transition">Coworking Space</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>Email: hello@ngopikel.com</li>
                    <li>Instagram: @ngopikel</li>
                    <li>Twitter: @ngopikel</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} Ngopikel. All rights reserved. Built with ❤️ and ☕</p>
        </div>
    </div>
</footer>
