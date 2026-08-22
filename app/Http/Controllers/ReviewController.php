<?php

namespace App\Http\Controllers;

use App\Models\CoffeeShop;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * Display user's reviews.
     */
    public function index(): View
    {
        $reviews = auth()->user()
            ->reviews()
            ->with(['coffeeShop.category'])
            ->latest()
            ->paginate(12);

        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create(CoffeeShop $coffeeShop): View|RedirectResponse
    {
        // Check if user already reviewed this coffee shop
        $existingReview = auth()->user()
            ->reviews()
            ->where('coffee_shop_id', $coffeeShop->id)
            ->first();

        if ($existingReview) {
            return redirect()
                ->route('reviews.edit', $existingReview)
                ->with('info', 'Anda sudah pernah memberikan ulasan. Silakan edit ulasan Anda.');
        }

        return view('reviews.create', compact('coffeeShop'));
    }

    /**
     * Store a newly created review.
     */
    public function store(Request $request, CoffeeShop $coffeeShop): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ], [
            'rating.required' => 'Rating wajib dipilih.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'comment.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        // Check if user already reviewed
        $existingReview = auth()->user()
            ->reviews()
            ->where('coffee_shop_id', $coffeeShop->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk coffee shop ini.');
        }

        // Create review
        auth()->user()->reviews()->create([
            'coffee_shop_id' => $coffeeShop->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()
            ->route('coffee-shops.show', $coffeeShop->slug)
            ->with('success', 'Terima kasih! Ulasan Anda berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the review.
     */
    public function edit(Review $review): View|RedirectResponse
    {
        Gate::authorize('update', $review);

        $review->load('coffeeShop');

        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the review.
     */
    public function update(Request $request, Review $review): RedirectResponse
    {
        Gate::authorize('update', $review);

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ], [
            'rating.required' => 'Rating wajib dipilih.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'comment.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        $review->update($validated);

        return redirect()
            ->route('coffee-shops.show', $review->coffeeShop->slug)
            ->with('success', 'Ulasan Anda berhasil diperbarui.');
    }

    /**
     * Remove the review.
     */
    public function destroy(Review $review): RedirectResponse
    {
        Gate::authorize('delete', $review);

        $coffeeShopSlug = $review->coffeeShop->slug;
        $review->delete();

        return redirect()
            ->route('coffee-shops.show', $coffeeShopSlug)
            ->with('success', 'Ulasan Anda berhasil dihapus.');
    }
}
