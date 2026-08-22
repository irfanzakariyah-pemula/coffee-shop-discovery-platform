<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoffeeShop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Get all coffee shops as GeoJSON for map display.
     */
    public function coffeeShops(Request $request): JsonResponse
    {
        $query = CoffeeShop::with(['category', 'facilities'])
            ->active();

        // Apply filters
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('facilities')) {
            $facilities = explode(',', $request->facilities);
            foreach ($facilities as $facilityId) {
                $query->whereHas('facilities', function ($q) use ($facilityId) {
                    $q->where('facilities.id', $facilityId);
                });
            }
        }

        if ($request->filled('min_rating')) {
            $query->minRating($request->min_rating);
        }

        $coffeeShops = $query->get();

        // Convert to GeoJSON format
        $features = $coffeeShops->map(function ($shop) {
            return [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float) $shop->longitude, (float) $shop->latitude]
                ],
                'properties' => [
                    'id' => $shop->id,
                    'name' => $shop->name,
                    'slug' => $shop->slug,
                    'category' => $shop->category->name,
                    'category_id' => $shop->category_id,
                    'address' => $shop->address,
                    'city' => $shop->city,
                    'area' => $shop->area,
                    'price_min' => $shop->price_min,
                    'price_max' => $shop->price_max,
                    'rating_avg' => $shop->rating_avg,
                    'rating_count' => $shop->rating_count,
                    'facilities' => $shop->facilities->map(fn($f) => [
                        'id' => $f->id,
                        'name' => $f->name,
                        'icon' => $f->icon,
                    ]),
                    'url' => route('coffee-shops.show', $shop->slug),
                ]
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }

    /**
     * Find nearby coffee shops based on user location.
     */
    public function nearby(Request $request): JsonResponse
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:0.5|max:50', // in kilometers
        ]);

        $lat = $request->latitude;
        $lng = $request->longitude;
        $radius = $request->radius ?? 10; // default 10km

        // Haversine formula for distance calculation
        $coffeeShops = CoffeeShop::selectRaw("
                *,
                (
                    6371 * acos(
                        cos(radians(?)) * 
                        cos(radians(latitude)) * 
                        cos(radians(longitude) - radians(?)) + 
                        sin(radians(?)) * 
                        sin(radians(latitude))
                    )
                ) AS distance
            ", [$lat, $lng, $lat])
            ->with(['category', 'facilities'])
            ->active()
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->limit(20)
            ->get();

        // Format response
        $results = $coffeeShops->map(function ($shop) {
            return [
                'id' => $shop->id,
                'name' => $shop->name,
                'slug' => $shop->slug,
                'category' => $shop->category->name,
                'address' => $shop->address,
                'city' => $shop->city,
                'area' => $shop->area,
                'latitude' => (float) $shop->latitude,
                'longitude' => (float) $shop->longitude,
                'distance' => round($shop->distance, 2), // in km
                'rating_avg' => $shop->rating_avg,
                'rating_count' => $shop->rating_count,
                'price_min' => $shop->price_min,
                'price_max' => $shop->price_max,
                'facilities' => $shop->facilities->pluck('icon'),
                'url' => route('coffee-shops.show', $shop->slug),
            ];
        });

        return response()->json([
            'location' => [
                'latitude' => $lat,
                'longitude' => $lng,
            ],
            'radius' => $radius,
            'count' => $results->count(),
            'results' => $results,
        ]);
    }
}
