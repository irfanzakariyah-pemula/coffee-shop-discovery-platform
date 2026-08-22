<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeShop;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Display a listing of menus for a coffee shop.
     */
    public function index(CoffeeShop $coffeeShop): View
    {
        $menus = $coffeeShop->menus()
            ->latest()
            ->paginate(20);

        return view('admin.menus.index', compact('coffeeShop', 'menus'));
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create(CoffeeShop $coffeeShop): View
    {
        $categories = ['Coffee', 'Food', 'Snacks', 'Beverages', 'Dessert'];
        
        return view('admin.menus.create', compact('coffeeShop', 'categories'));
    }

    /**
     * Store a newly created menu.
     */
    public function store(Request $request, CoffeeShop $coffeeShop): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'in:Coffee,Food,Snacks,Beverages,Dessert'],
            'price' => ['required', 'integer', 'min:0'],
            'is_available' => ['boolean'],
        ], [
            'name.required' => 'Nama menu wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'price.required' => 'Harga wajib diisi.',
            'price.min' => 'Harga tidak boleh negatif.',
        ]);

        $coffeeShop->menus()->create($validated);

        return redirect()
            ->route('admin.coffee-shops.menus.index', $coffeeShop)
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the menu.
     */
    public function edit(CoffeeShop $coffeeShop, Menu $menu): View
    {
        // Ensure menu belongs to this coffee shop
        abort_if($menu->coffee_shop_id !== $coffeeShop->id, 404);

        $categories = ['Coffee', 'Food', 'Snacks', 'Beverages', 'Dessert'];
        
        return view('admin.menus.edit', compact('coffeeShop', 'menu', 'categories'));
    }

    /**
     * Update the menu.
     */
    public function update(Request $request, CoffeeShop $coffeeShop, Menu $menu): RedirectResponse
    {
        // Ensure menu belongs to this coffee shop
        abort_if($menu->coffee_shop_id !== $coffeeShop->id, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string', 'in:Coffee,Food,Snacks,Beverages,Dessert'],
            'price' => ['required', 'integer', 'min:0'],
            'is_available' => ['boolean'],
        ], [
            'name.required' => 'Nama menu wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'price.required' => 'Harga wajib diisi.',
            'price.min' => 'Harga tidak boleh negatif.',
        ]);

        $menu->update($validated);

        return redirect()
            ->route('admin.coffee-shops.menus.index', $coffeeShop)
            ->with('success', 'Menu berhasil diupdate!');
    }

    /**
     * Remove the menu.
     */
    public function destroy(CoffeeShop $coffeeShop, Menu $menu): RedirectResponse
    {
        // Ensure menu belongs to this coffee shop
        abort_if($menu->coffee_shop_id !== $coffeeShop->id, 404);

        $menu->delete();

        return redirect()
            ->route('admin.coffee-shops.menus.index', $coffeeShop)
            ->with('success', 'Menu berhasil dihapus!');
    }
}
