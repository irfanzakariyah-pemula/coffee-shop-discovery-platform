<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeShop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Basic Statistics
        $stats = [
            'total_coffee_shops' => CoffeeShop::count(),
            'active_coffee_shops' => CoffeeShop::where('is_active', true)->count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_reviews' => Review::count(),
            'total_favorites' => Favorite::count(),
            'avg_rating' => round(Review::avg('rating'), 2),
        ];

        // Recent Activity
        $recent_reviews = Review::with(['user', 'coffeeShop'])
            ->latest()
            ->take(5)
            ->get();

        $recent_users = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        // Popular Coffee Shops (by reviews)
        $popular_shops = CoffeeShop::withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->take(5)
            ->get();

        // Top Reviewers
        $top_reviewers = User::withCount('reviews')
            ->having('reviews_count', '>', 0)
            ->orderBy('reviews_count', 'desc')
            ->take(5)
            ->get();

        // Monthly Stats (last 6 months)
        $monthly_stats = $this->getMonthlyStats();

        return view('admin.dashboard', compact(
            'stats',
            'recent_reviews',
            'recent_users',
            'popular_shops',
            'top_reviewers',
            'monthly_stats'
        ));
    }

    private function getMonthlyStats(): array
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = [
                'month' => $date->format('M Y'),
                'reviews' => Review::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'users' => User::where('role', 'user')
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }
        return $months;
    }
}
