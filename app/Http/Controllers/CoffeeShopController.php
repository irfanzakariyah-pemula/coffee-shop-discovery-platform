<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CoffeeShop;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CoffeeShopController extends Controller
{
    /**
     * Display a listing of coffee shops.
     */
    public function index(Request $request): View
    {
        $query = CoffeeShop::with(['category', 'facilities'])
            ->active();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->inCity($request->city);
        }

        // Filter by minimum rating
        if ($request->filled('rating')) {
            $query->minRating($request->rating);
        }

        // Filter by price range
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->priceBetween($request->price_min, $request->price_max);
        }

        // Filter by facilities
        if ($request->filled('facilities')) {
            $facilities = is_array($request->facilities) 
                ? $request->facilities 
                : explode(',', $request->facilities);
            
            foreach ($facilities as $facilityId) {
                $query->whereHas('facilities', function ($q) use ($facilityId) {
                    $q->where('facilities.id', $facilityId);
                });
            }
        }

        // Sorting
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        
        $allowedSorts = ['name', 'rating_avg', 'price_min', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Paginate results
        $coffeeShops = $query->paginate(12)->withQueryString();

        // Get filter options (cached)
        $categories = Cache::remember('categories_all', 3600, function () {
            return Category::all();
        });
        
        $facilities = Cache::remember('facilities_all', 3600, function () {
            return Facility::all();
        });
        
        $cities = Cache::remember('cities_list', 1800, function () {
            return CoffeeShop::select('city')
                ->distinct()
                ->orderBy('city')
                ->pluck('city');
        });

        return view('coffee-shops.index', compact(
            'coffeeShops',
            'categories',
            'facilities',
            'cities'
        ));
    }

    /**
     * Display the specified coffee shop.
     */
    public function show(string $slug): View
    {
        $coffeeShop = CoffeeShop::with([
            'category',
            'facilities',
            'reviews.user',
            'menus',
            'promotions' => function ($query) {
                $query->active();
            },
            'images',
        ])
        ->where('slug', $slug)
        ->firstOrFail();

        // Increment view count
        $coffeeShop->increment('view_count');

        // Check if user has favorited this coffee shop
        $isFavorited = auth()->check() 
            ? auth()->user()->hasFavorited($coffeeShop)
            : false;

        return view('coffee-shops.show', compact('coffeeShop', 'isFavorited'));
    }
}
