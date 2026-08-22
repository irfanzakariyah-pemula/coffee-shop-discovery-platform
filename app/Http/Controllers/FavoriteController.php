<?php

namespace App\Http\Controllers;

use App\Models\CoffeeShop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    /**
     * Display user's favorite coffee shops.
     */
    public function index(): View
    {
        $favorites = auth()->user()
            ->favoriteCoffeeShops()
            ->with(['category', 'facilities'])
            ->withCount('reviews')
            ->latest('favorites.created_at')
            ->paginate(12);

        return view('favorites.index', compact('favorites'));
    }

    /**
     * Toggle favorite status (add or remove).
     */
    public function toggle(CoffeeShop $coffeeShop): JsonResponse
    {
        $user = auth()->user();
        
        // Check if already favorited
        $favorite = $user->favorites()
            ->where('coffee_shop_id', $coffeeShop->id)
            ->first();

        if ($favorite) {
            // Remove from favorites
            $favorite->delete();
            
            return response()->json([
                'status' => 'removed',
                'message' => 'Dihapus dari favorit',
                'is_favorited' => false,
                'favorites_count' => $coffeeShop->favorites()->count(),
            ]);
        } else {
            // Add to favorites
            $user->favorites()->create([
                'coffee_shop_id' => $coffeeShop->id,
            ]);
            
            return response()->json([
                'status' => 'added',
                'message' => 'Ditambahkan ke favorit',
                'is_favorited' => true,
                'favorites_count' => $coffeeShop->favorites()->count(),
            ]);
        }
    }

    /**
     * Add to favorites (for non-AJAX requests).
     */
    public function store(CoffeeShop $coffeeShop): RedirectResponse
    {
        $user = auth()->user();

        // Check if already favorited
        if ($user->hasFavorited($coffeeShop)) {
            return back()->with('error', 'Coffee shop sudah ada di favorit Anda.');
        }

        $user->favorites()->create([
            'coffee_shop_id' => $coffeeShop->id,
        ]);

        return back()->with('success', 'Berhasil ditambahkan ke favorit!');
    }

    /**
     * Remove from favorites (for non-AJAX requests).
     */
    public function destroy(CoffeeShop $coffeeShop): RedirectResponse
    {
        $user = auth()->user();

        $favorite = $user->favorites()
            ->where('coffee_shop_id', $coffeeShop->id)
            ->first();

        if (!$favorite) {
            return back()->with('error', 'Coffee shop tidak ada di favorit Anda.');
        }

        $favorite->delete();

        return back()->with('success', 'Berhasil dihapus dari favorit!');
    }
}
