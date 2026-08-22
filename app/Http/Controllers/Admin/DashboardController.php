<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeShop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Cache basic statistics for 5 minutes
        $stats = Cache::remember('admin_dashboard_stats', 300, function () {
            return [
                'total_coffee_shops' => CoffeeShop::count(),
                'active_coffee_shops' => CoffeeShop::where('is_active', true)->count(),
                'total_users' => User::where('role', 'user')->count(),
                'total_reviews' => Review::count(),
                'total_favorites' => Favorite::count(),
                'avg_rating' => round(Review::avg('rating') ?? 0, 2),
            ];
        });

        // Recent Activity (no cache - real-time data)
        $recent_reviews = Review::with(['user:id,name', 'coffeeShop:id,name,slug'])
            ->latest()
            ->take(5)
            ->get();

        $recent_users = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        // Cache popular shops for 15 minutes
        $popular_shops = Cache::remember('popular_coffee_shops', 900, function () {
            return CoffeeShop::withCount('reviews')
                ->orderBy('reviews_count', 'desc')
                ->take(5)
                ->get();
        });

        // Cache top reviewers for 15 minutes
        $top_reviewers = Cache::remember('top_reviewers', 900, function () {
            return User::withCount('reviews')
                ->having('reviews_count', '>', 0)
                ->orderBy('reviews_count', 'desc')
                ->take(5)
                ->get();
        });

        // Cache monthly stats for 1 hour
        $monthly_stats = Cache::remember('monthly_stats', 3600, function () {
            return $this->getMonthlyStats();
        });

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
