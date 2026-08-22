@extends('layouts.app')

@section('title', 'Peta Coffee Shop')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map {
        height: calc(100vh - 4rem);
        width: 100%;
    }
</style>
@endpush

@section('content')
<div class="bg-gray-50" x-data="mapComponent()">
    <!-- Top Bar with Filters -->
    <div class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-900">🗺️ Peta Coffee Shop</h1>
                    <span class="text-sm text-gray-500" x-text="'Menampilkan ' + markerCount + ' lokasi'"></span>
                </div>

                <div class="flex items-center space-x-3">
                    <!-- Find Nearby Button -->
                    <button @click="findNearby()" 
                        :disabled="loadingNearby"
                        class="px-4 py-2 bg-coffee-600 text-white rounded-lg font-semibold hover:bg-coffee-700 transition disabled:opacity-50">
                        <span x-show="!loadingNearby">📍 Cari Terdekat</span>
                        <span x-show="loadingNearby">⏳ Mencari...</span>
                    </button>

                    <!-- Filter Toggle -->
                    <button @click="showFilters = !showFilters" 
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        <span x-show="!showFilters">🔍 Filter</span>
                        <span x-show="showFilters">✕ Tutup Filter</span>
                    </button>

                    <!-- Back to List -->
                    <a href="{{ route('coffee-shops.index') }}" 
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        📋 View List
                    </a>
                </div>
            </div>

            <!-- Filter Panel -->
            <div x-show="showFilters" x-collapse class="mt-4 pt-4 border-t">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select x-model="filters.category" @change="applyFilters()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Min Rating Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating Minimum</label>
                        <select x-model="filters.min_rating" @change="applyFilters()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-coffee-500 focus:border-coffee-500">
                            <option value="">Semua Rating</option>
                            <option value="4">⭐ 4+</option>
                            <option value="3">⭐ 3+</option>
                            <option value="2">⭐ 2+</option>
                        </select>
                    </div>

                    <!-- Facilities Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                        <div class="flex flex-wrap gap-2 max-h-20 overflow-y-auto">
                            @foreach($facilities as $facility)
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" value="{{ $facility->id }}" 
                                        x-model="filters.facilities" @change="applyFilters()"
                                        class="rounded border-gray-300 text-coffee-600 focus:ring-coffee-500 mr-1">
                                    <span>{{ $facility->icon }} {{ $facility->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Reset Filter -->
                <div class="mt-4">
                    <button @click="resetFilters()" 
                        class="text-sm text-coffee-600 hover:text-coffee-700 font-medium">
                        🔄 Reset Semua Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div id="map"></div>

    <!-- Nearby Results Sidebar -->
    <div x-show="showNearbyResults" x-cloak
        class="fixed top-20 right-4 w-96 max-h-[80vh] bg-white rounded-lg shadow-2xl overflow-hidden z-[1000]">
        <div class="p-4 bg-coffee-600 text-white flex items-center justify-between">
            <h3 class="font-semibold">📍 Coffee Shop Terdekat</h3>
            <button @click="showNearbyResults = false" class="text-white hover:text-gray-200">
                ✕
            </button>
        </div>
        <div class="overflow-y-auto max-h-[calc(80vh-4rem)]">
            <template x-if="nearbyResults.length === 0">
                <div class="p-8 text-center text-gray-500">
                    Tidak ada coffee shop dalam radius <span x-text="nearbyRadius"></span> km
                </div>
            </template>
            <template x-for="shop in nearbyResults" :key="shop.id">
                <a :href="shop.url" 
                    class="block p-4 border-b hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900" x-text="shop.name"></h4>
                            <p class="text-sm text-gray-600" x-text="shop.area + ', ' + shop.city"></p>
                            <div class="mt-2 flex items-center space-x-2">
                                <span class="text-xs bg-coffee-100 text-coffee-700 px-2 py-1 rounded" 
                                    x-text="shop.distance + ' km'"></span>
                                <template x-if="shop.rating_count > 0">
                                    <span class="text-xs text-gray-600">
                                        ⭐ <span x-text="shop.rating_avg.toFixed(1)"></span>
                                    </span>
                                </template>
                            </div>
                        </div>
                    </div>
                </a>
            </template>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
function mapComponent() {
    return {
        map: null,
        markers: L.layerGroup(),
        filters: {
            category: '',
            min_rating: '',
            facilities: []
        },
        showFilters: false,
        markerCount: 0,
        loadingNearby: false,
        showNearbyResults: false,
        nearbyResults: [],
        nearbyRadius: 10,
        userLocation: null,

        init() {
            this.initMap();
            this.loadCoffeeShops();
        },

        initMap() {
            // Initialize map centered on Indonesia
            this.map = L.map('map').setView([-6.2088, 106.8456], 12);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(this.map);

            // Add markers layer
            this.markers.addTo(this.map);
        },

        async loadCoffeeShops() {
            try {
                const params = new URLSearchParams();
                if (this.filters.category) params.append('category', this.filters.category);
                if (this.filters.min_rating) params.append('min_rating', this.filters.min_rating);
                if (this.filters.facilities.length > 0) params.append('facilities', this.filters.facilities.join(','));

                const response = await fetch(`{{ route('api.map.coffee-shops') }}?${params}`);
                const data = await response.json();

                this.renderMarkers(data);
            } catch (error) {
                console.error('Error loading coffee shops:', error);
                alert('Gagal memuat data coffee shop');
            }
        },

        renderMarkers(geojson) {
            // Clear existing markers
            this.markers.clearLayers();

            if (!geojson.features || geojson.features.length === 0) {
                this.markerCount = 0;
                return;
            }

            // Add new markers
            geojson.features.forEach(feature => {
                const [lng, lat] = feature.geometry.coordinates;
                const props = feature.properties;

                // Create custom icon based on category
                const icon = L.divIcon({
                    html: `<div class="bg-coffee-600 text-white rounded-full w-10 h-10 flex items-center justify-center text-xl shadow-lg border-2 border-white">☕</div>`,
                    className: 'custom-marker',
                    iconSize: [40, 40],
                    iconAnchor: [20, 20]
                });

                // Create marker
                const marker = L.marker([lat, lng], { icon })
                    .bindPopup(this.createPopupContent(props));

                this.markers.addLayer(marker);
            });

            this.markerCount = geojson.features.length;

            // Fit map to markers bounds
            if (this.markers.getLayers().length > 0) {
                const bounds = this.markers.getBounds();
                this.map.fitBounds(bounds, { padding: [50, 50] });
            }
        },

        createPopupContent(props) {
            const ratingHtml = props.rating_count > 0 
                ? `<div class="flex items-center space-x-1 text-sm">
                    <span>⭐</span>
                    <span class="font-semibold">${props.rating_avg.toFixed(1)}</span>
                    <span class="text-gray-500">(${props.rating_count})</span>
                   </div>`
                : '<span class="text-sm text-gray-500">Belum ada rating</span>';

            return `
                <div class="min-w-[250px]">
                    <h3 class="font-bold text-lg mb-2">${props.name}</h3>
                    <p class="text-sm text-gray-600 mb-2">${props.category}</p>
                    <p class="text-sm text-gray-700 mb-2">${props.area}, ${props.city}</p>
                    ${ratingHtml}
                    <div class="mt-3 pt-3 border-t">
                        <p class="text-sm text-coffee-600 font-semibold mb-2">
                            Rp ${props.price_min.toLocaleString()} - ${props.price_max.toLocaleString()}
                        </p>
                        <a href="${props.url}" 
                            class="block w-full text-center bg-coffee-600 text-white py-2 rounded hover:bg-coffee-700 transition text-sm font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            `;
        },

        applyFilters() {
            this.loadCoffeeShops();
        },

        resetFilters() {
            this.filters = {
                category: '',
                min_rating: '',
                facilities: []
            };
            this.loadCoffeeShops();
        },

        async findNearby() {
            if (this.loadingNearby) return;

            this.loadingNearby = true;
            this.showNearbyResults = false;

            try {
                // Get user location
                const position = await new Promise((resolve, reject) => {
                    navigator.geolocation.getCurrentPosition(resolve, reject);
                });

                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                this.userLocation = [lat, lng];

                // Add user location marker
                L.marker([lat, lng], {
                    icon: L.divIcon({
                        html: '<div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg border-2 border-white">📍</div>',
                        className: 'user-location-marker',
                        iconSize: [48, 48],
                        iconAnchor: [24, 24]
                    })
                }).addTo(this.map).bindPopup('📍 Lokasi Anda').openPopup();

                // Center map on user
                this.map.setView([lat, lng], 14);

                // Fetch nearby shops
                const response = await fetch(`{{ route('api.map.nearby') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        latitude: lat,
                        longitude: lng,
                        radius: this.nearbyRadius
                    })
                });

                const data = await response.json();
                this.nearbyResults = data.results;
                this.showNearbyResults = true;

            } catch (error) {
                console.error('Geolocation error:', error);
                alert('Gagal mendapatkan lokasi Anda. Pastikan Anda mengizinkan akses lokasi.');
            } finally {
                this.loadingNearby = false;
            }
        }
    }
}
</script>
@endpush
