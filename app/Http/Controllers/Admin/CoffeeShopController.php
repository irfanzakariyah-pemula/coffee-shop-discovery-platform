<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoffeeShopRequest;
use App\Models\Category;
use App\Models\CoffeeShop;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CoffeeShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $coffeeShops = CoffeeShop::with(['category'])
            ->latest()
            ->paginate(20);

        return view('admin.coffee-shops.index', compact('coffeeShops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $facilities = Facility::all();

        return view('admin.coffee-shops.create', compact('categories', 'facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoffeeShopRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        // Generate slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(6);

        // Create coffee shop
        $coffeeShop = CoffeeShop::create($data);

        // Attach facilities
        if ($request->filled('facilities')) {
            $coffeeShop->facilities()->attach($request->facilities);
        }

        return redirect()
            ->route('admin.coffee-shops.index')
            ->with('success', 'Coffee shop berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CoffeeShop $coffeeShop): View
    {
        $coffeeShop->load(['category', 'facilities', 'reviews.user']);

        return view('admin.coffee-shops.show', compact('coffeeShop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoffeeShop $coffeeShop): View
    {
        $categories = Category::all();
        $facilities = Facility::all();

        return view('admin.coffee-shops.edit', compact('coffeeShop', 'categories', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoffeeShopRequest $request, CoffeeShop $coffeeShop): RedirectResponse
    {
        $data = $request->validated();

        // Update slug if name changed
        if ($data['name'] !== $coffeeShop->name) {
            $data['slug'] = Str::slug($data['name']) . '-' . Str::random(6);
        }

        // Update coffee shop
        $coffeeShop->update($data);

        // Sync facilities
        if ($request->filled('facilities')) {
            $coffeeShop->facilities()->sync($request->facilities);
        } else {
            $coffeeShop->facilities()->detach();
        }

        return redirect()
            ->route('admin.coffee-shops.index')
            ->with('success', 'Coffee shop berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoffeeShop $coffeeShop): RedirectResponse
    {
        $coffeeShop->delete();

        return redirect()
            ->route('admin.coffee-shops.index')
            ->with('success', 'Coffee shop berhasil dihapus!');
    }
}
