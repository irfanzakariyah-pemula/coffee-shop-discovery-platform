<?php

namespace Tests\Feature;

use App\Models\CoffeeShop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_add_favorite(): void
    {
        $user = User::factory()->create();
        $coffeeShop = CoffeeShop::factory()->create(['is_active' => true]);

        $response = $this->actingAs($user)->post("/favorites/{$coffeeShop->id}/toggle");

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'added',
            'is_favorited' => true,
        ]);

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'coffee_shop_id' => $coffeeShop->id,
        ]);
    }

    public function test_authenticated_user_can_remove_favorite(): void
    {
        $user = User::factory()->create();
        $coffeeShop = CoffeeShop::factory()->create(['is_active' => true]);

        // Add favorite first
        $user->favorites()->create(['coffee_shop_id' => $coffeeShop->id]);

        // Remove favorite
        $response = $this->actingAs($user)->post("/favorites/{$coffeeShop->id}/toggle");

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'removed',
            'is_favorited' => false,
        ]);

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'coffee_shop_id' => $coffeeShop->id,
        ]);
    }

    public function test_guest_cannot_add_favorite(): void
    {
        $coffeeShop = CoffeeShop::factory()->create();

        $response = $this->post("/favorites/{$coffeeShop->id}/toggle");

        $response->assertRedirect('/login');
    }

    public function test_user_can_view_favorites_page(): void
    {
        $user = User::factory()->create();
        $coffeeShop = CoffeeShop::factory()->create(['is_active' => true]);
        $user->favorites()->create(['coffee_shop_id' => $coffeeShop->id]);

        $response = $this->actingAs($user)->get('/favorites');

        $response->assertStatus(200);
        $response->assertSee($coffeeShop->name);
    }
}
