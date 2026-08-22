<?php

namespace Tests\Unit;

use App\Models\CoffeeShop;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoffeeShopModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_coffee_shop_has_slug_attribute(): void
    {
        $coffeeShop = CoffeeShop::factory()->create(['name' => 'Test Coffee']);

        $this->assertNotNull($coffeeShop->slug);
        $this->assertStringContainsString('test-coffee', strtolower($coffeeShop->slug));
    }

    public function test_active_scope_only_returns_active_shops(): void
    {
        CoffeeShop::factory()->create(['is_active' => true]);
        CoffeeShop::factory()->create(['is_active' => false]);

        $activeShops = CoffeeShop::active()->get();

        $this->assertCount(1, $activeShops);
        $this->assertTrue($activeShops->first()->is_active);
    }

    public function test_min_rating_scope_filters_correctly(): void
    {
        CoffeeShop::factory()->create(['rating_avg' => 4.5, 'rating_count' => 10]);
        CoffeeShop::factory()->create(['rating_avg' => 3.0, 'rating_count' => 5]);
        CoffeeShop::factory()->create(['rating_avg' => 0, 'rating_count' => 0]);

        $highRatedShops = CoffeeShop::minRating(4)->get();

        $this->assertCount(1, $highRatedShops);
        $this->assertEquals(4.5, $highRatedShops->first()->rating_avg);
    }

    public function test_in_city_scope_filters_by_city(): void
    {
        CoffeeShop::factory()->create(['city' => 'Jakarta']);
        CoffeeShop::factory()->create(['city' => 'Bandung']);

        $jakartaShops = CoffeeShop::inCity('Jakarta')->get();

        $this->assertCount(1, $jakartaShops);
        $this->assertEquals('Jakarta', $jakartaShops->first()->city);
    }
}
