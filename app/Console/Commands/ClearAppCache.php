<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class ClearAppCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-cache {--all : Clear all caches including Laravel caches}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear application caches (categories, cities, stats, etc.)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🧹 Clearing application caches...');

        // Clear specific app caches
        $caches = [
            'categories_all',
            'facilities_all',
            'cities_list',
            'popular_coffee_shops',
            'top_reviewers',
            'admin_dashboard_stats',
            'monthly_stats',
        ];

        foreach ($caches as $cache) {
            Cache::forget($cache);
            $this->line("   ✓ Cleared: {$cache}");
        }

        // Clear all Laravel caches if --all flag is used
        if ($this->option('all')) {
            $this->info('🧹 Clearing Laravel caches...');
            
            Artisan::call('cache:clear');
            $this->line('   ✓ Cache cleared');
            
            Artisan::call('config:clear');
            $this->line('   ✓ Config cache cleared');
            
            Artisan::call('route:clear');
            $this->line('   ✓ Route cache cleared');
            
            Artisan::call('view:clear');
            $this->line('   ✓ View cache cleared');
        }

        $this->info('✨ All caches cleared successfully!');

        return Command::SUCCESS;
    }
}
