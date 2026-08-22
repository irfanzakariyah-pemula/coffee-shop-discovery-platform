<?php

namespace Tests\Unit;

use App\Models\CoffeeShop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_admin_returns_true_for_admin_user(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->assertTrue($admin->isAdmin());
    }

    public function test_is_admin_returns_false_for_regular_user(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->assertFalse($user->isAdmin());
    }

    public function test_has_favorited_returns_true_when_shop_is_favorited(): void
    {
        $user = User::factory()->create();
        $coffeeShop = CoffeeShop::factory()->create();
        
        $user->favorites()->create(['coffee_shop_id' => $coffeeShop->id]);

        $this->assertTrue($user->hasFavorited($coffeeShop));
    }

    public function test_has_favorited_returns_false_when_shop_is_not_favorited(): void
    {
        $user = User::factory()->create();
        $coffeeShop = CoffeeShop::factory()->create();

        $this->assertFalse($user->hasFavorited($coffeeShop));
    }
}
