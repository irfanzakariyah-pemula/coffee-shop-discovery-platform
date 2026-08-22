<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeShop;
use App\Models\Promotion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromotionController extends Controller
{
    /**
     * Display a listing of promotions for a coffee shop.
     */
    public function index(CoffeeShop $coffeeShop): View
    {
        $promotions = $coffeeShop->promotions()
            ->latest()
            ->paginate(20);

        return view('admin.promotions.index', compact('coffeeShop', 'promotions'));
    }

    /**
     * Show the form for creating a new promotion.
     */
    public function create(CoffeeShop $coffeeShop): View
    {
        $discountTypes = [
            'percentage' => 'Persentase (%)',
            'fixed' => 'Nominal (Rp)',
            'buy_x_get_y' => 'Buy X Get Y'
        ];
        
        return view('admin.promotions.create', compact('coffeeShop', 'discountTypes'));
    }

    /**
     * Store a newly created promotion.
     */
    public function store(Request $request, CoffeeShop $coffeeShop): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'discount_type' => ['required', 'in:percentage,fixed,buy_x_get_y'],
            'discount_value' => ['required', 'integer', 'min:1'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'min_purchase' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ], [
            'title.required' => 'Judul promo wajib diisi.',
            'discount_type.required' => 'Tipe diskon wajib dipilih.',
            'discount_value.required' => 'Nilai diskon wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh di masa lalu.',
            'end_date.required' => 'Tanggal berakhir wajib diisi.',
            'end_date.after' => 'Tanggal berakhir harus setelah tanggal mulai.',
        ]);

        $coffeeShop->promotions()->create($validated);

        return redirect()
            ->route('admin.coffee-shops.promotions.index', $coffeeShop)
            ->with('success', 'Promo berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the promotion.
     */
    public function edit(CoffeeShop $coffeeShop, Promotion $promotion): View
    {
        // Ensure promotion belongs to this coffee shop
        abort_if($promotion->coffee_shop_id !== $coffeeShop->id, 404);

        $discountTypes = [
            'percentage' => 'Persentase (%)',
            'fixed' => 'Nominal (Rp)',
            'buy_x_get_y' => 'Buy X Get Y'
        ];
        
        return view('admin.promotions.edit', compact('coffeeShop', 'promotion', 'discountTypes'));
    }

    /**
     * Update the promotion.
     */
    public function update(Request $request, CoffeeShop $coffeeShop, Promotion $promotion): RedirectResponse
    {
        // Ensure promotion belongs to this coffee shop
        abort_if($promotion->coffee_shop_id !== $coffeeShop->id, 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'discount_type' => ['required', 'in:percentage,fixed,buy_x_get_y'],
            'discount_value' => ['required', 'integer', 'min:1'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'min_purchase' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ], [
            'title.required' => 'Judul promo wajib diisi.',
            'discount_type.required' => 'Tipe diskon wajib dipilih.',
            'discount_value.required' => 'Nilai diskon wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.required' => 'Tanggal berakhir wajib diisi.',
            'end_date.after' => 'Tanggal berakhir harus setelah tanggal mulai.',
        ]);

        $promotion->update($validated);

        return redirect()
            ->route('admin.coffee-shops.promotions.index', $coffeeShop)
            ->with('success', 'Promo berhasil diupdate!');
    }

    /**
     * Remove the promotion.
     */
    public function destroy(CoffeeShop $coffeeShop, Promotion $promotion): RedirectResponse
    {
        // Ensure promotion belongs to this coffee shop
        abort_if($promotion->coffee_shop_id !== $coffeeShop->id, 404);

        $promotion->delete();

        return redirect()
            ->route('admin.coffee-shops.promotions.index', $coffeeShop)
            ->with('success', 'Promo berhasil dihapus!');
    }
}
