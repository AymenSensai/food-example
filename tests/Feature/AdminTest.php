<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_are_protected(): void
    {
        $response = $this->get('/admin/categories');
        $response->assertRedirect('/login');

        $response = $this->get('/admin/food-items');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_admin_pages(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/categories');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/admin/food-items');
        $response->assertStatus(200);
    }

    public function test_can_create_category(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/categories', [
            'name' => 'Test Category',
            'description' => 'Test Description',
        ]);

        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Test Category']);
    }

    public function test_can_create_food_item(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post('/admin/food-items', [
            'category_id' => $category->id,
            'name' => 'Test Food',
            'description' => 'Test Desc',
            'price' => 10.99,
        ]);

        $response->assertRedirect('/admin/food-items');
        $this->assertDatabaseHas('food_items', ['name' => 'Test Food']);
    }
}
