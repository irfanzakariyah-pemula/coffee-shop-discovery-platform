<?php

namespace Tests\Feature;

use App\Models\CoffeeShop;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_review(): void
    {
        $user = User::factory()->create();
        $coffeeShop = CoffeeShop::factory()->create(['is_active' => true]);

        $response = $this->actingAs($user)->post("/coffee-shops/{$coffeeShop->id}/reviews", [
            'rating' => 5,
            'comment' => 'Great coffee shop!',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'coffee_shop_id' => $coffeeShop->id,
            'rating' => 5,
        ]);
    }

    public function test_guest_cannot_create_review(): void
    {
        $coffeeShop = CoffeeShop::factory()->create();

        $response = $this->post("/coffee-shops/{$coffeeShop->id}/reviews", [
            'rating' => 5,
            'comment' => 'Great coffee shop!',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_user_cannot_review_same_coffee_shop_twice(): void
    {
        $user = User::factory()->create();
        $coffeeShop = CoffeeShop::factory()->create(['is_active' => true]);

        // First review
        Review::factory()->create([
            'user_id' => $user->id,
            'coffee_shop_id' => $coffeeShop->id,
        ]);

        // Try second review
        $response = $this->actingAs($user)->post("/coffee-shops/{$coffeeShop->id}/reviews", [
            'rating' => 5,
            'comment' => 'Another review',
        ]);

        $response->assertSessionHas('error');
        $this->assertCount(1, $coffeeShop->reviews);
    }

    public function test_user_can_edit_own_review(): void
    {
        $user = User::factory()->create();
        $review = Review::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/reviews/{$review->id}", [
            'rating' => 4,
            'comment' => 'Updated comment',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'rating' => 4,
            'comment' => 'Updated comment',
        ]);
    }

    public function test_user_cannot_edit_others_review(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $review = Review::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($user)->put("/reviews/{$review->id}", [
            'rating' => 4,
            'comment' => 'Hacked',
        ]);

        $response->assertStatus(403);
    }

    public function test_coffee_shop_rating_is_updated_after_review(): void
    {
        $user = User::factory()->create();
        $coffeeShop = CoffeeShop::factory()->create([
            'is_active' => true,
            'rating_avg' => 0,
            'rating_count' => 0,
        ]);

        $this->actingAs($user)->post("/coffee-shops/{$coffeeShop->id}/reviews", [
            'rating' => 5,
            'comment' => 'Excellent!',
        ]);

        $coffeeShop->refresh();
        
        $this->assertEquals(5, $coffeeShop->rating_avg);
        $this->assertEquals(1, $coffeeShop->rating_count);
    }
}
