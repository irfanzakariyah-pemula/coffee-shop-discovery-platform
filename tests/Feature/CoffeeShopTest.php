<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CoffeeShop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoffeeShopTest extends TestCase
{
    use RefreshDatabase;

    public function test_coffee_shops_list_page_is_displayed(): void
    {
        $response = $this->get('/coffee-shops');

        $response->assertStatus(200);
        $response->assertSee('Jelajah Coffee Shop');
    }

    public function test_coffee_shops_can_be_filtered_by_category(): void
    {
        $category = Category::factory()->create(['name' => 'Cafe']);
        $coffeeShop = CoffeeShop::factory()->create([
            'category_id' => $category->id,
            'is_active' => true,
        ]);

        $response = $this->get('/coffee-shops?category=' . $category->id);

        $response->assertStatus(200);
        $response->assertSee($coffeeShop->name);
    }

    public function test_coffee_shop_detail_page_is_displayed(): void
    {
        $coffeeShop = CoffeeShop::factory()->create(['is_active' => true]);

        $response = $this->get('/coffee-shops/' . $coffeeShop->slug);

        $response->assertStatus(200);
        $response->assertSee($coffeeShop->name);
        $response->assertSee($coffeeShop->address);
    }

    public function test_inactive_coffee_shops_are_not_shown(): void
    {
        $coffeeShop = CoffeeShop::factory()->create(['is_active' => false]);

        $response = $this->get('/coffee-shops');

        $response->assertStatus(200);
        $response->assertDontSee($coffeeShop->name);
    }

    public function test_admin_can_create_coffee_shop(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/coffee-shops', [
            'name' => 'Test Coffee Shop',
            'category_id' => $category->id,
            'address' => 'Test Address',
            'city' => 'Jakarta',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'price_min' => 15000,
            'price_max' => 50000,
            'is_active' => true,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('coffee_shops', [
            'name' => 'Test Coffee Shop',
            'city' => 'Jakarta',
        ]);
    }

    public function test_non_admin_cannot_access_admin_coffee_shop_routes(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get('/admin/coffee-shops');

        $response->assertStatus(403);
    }
}
