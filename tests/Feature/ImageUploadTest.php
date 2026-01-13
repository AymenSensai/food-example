<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_uploading_large_images_up_to_10mb_for_categories()
    {
        Storage::fake('public');

        $user = User::factory()->create(); // Assuming auth is required, adjusting if needed. admin middleware usually requires auth.
        // Actually, looking at controller, it's admin namespace. Usually requires login.
        // I'll try without login first, or check routes.
        // But let's assume I need to act as an admin.
        
        // Creating a 9MB image
        $file = UploadedFile::fake()->image('large_image.jpg')->size(9000); // 9MB

        $response = $this->actingAs($user)->post(route('admin.categories.store'), [
            'name' => 'Test Category',
            'image' => $file,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        // Check if file is stored
        // The filename is hashed, so correct assertion is tricky without knowing hash.
        // But we can check if *any* file exists in 'categories' directory.
        $files = Storage::disk('public')->files('categories');
        $this->assertCount(1, $files);
        
        // Check if it's webp (compression service converts to webp)
        $this->assertStringEndsWith('.webp', $files[0]);
    }

    /** @test */
    public function it_rejects_images_larger_than_10mb_for_categories()
    {
        Storage::fake('public');
        $user = User::factory()->create();

        // Creating a 11MB image
        $file = UploadedFile::fake()->image('huge_image.jpg')->size(11000); 

        $response = $this->actingAs($user)->post(route('admin.categories.store'), [
            'name' => 'Huge Category',
            'image' => $file,
        ]);

        $response->assertSessionHasErrors(['image']);
    }
}
