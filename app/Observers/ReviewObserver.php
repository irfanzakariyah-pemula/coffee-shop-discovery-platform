<?php

namespace App\Observers;

use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        $this->updateCoffeeShopRating($review);
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        $this->updateCoffeeShopRating($review);
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        $this->updateCoffeeShopRating($review);
    }

    /**
     * Update coffee shop's rating statistics.
     */
    private function updateCoffeeShopRating(Review $review): void
    {
        $coffeeShop = $review->coffeeShop;

        // Calculate new averages
        $stats = $coffeeShop->reviews()->selectRaw('
            AVG(rating) as avg_rating,
            COUNT(*) as total_reviews
        ')->first();

        // Update coffee shop
        $coffeeShop->update([
            'rating_avg' => round($stats->avg_rating, 2) ?? 0,
            'rating_count' => $stats->total_reviews ?? 0,
        ]);
    }
}
