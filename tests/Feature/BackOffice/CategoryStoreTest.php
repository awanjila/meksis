<?php

namespace Tests\Feature\BackOffice;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CategoryStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_can_add_a_category_without_an_image(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('category.store'), [
                'category_name' => 'Water Tanks',
                'meta_title' => 'Water Tanks',
                'category_description' => 'Steel and GRP tanks',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('categories', [
            'category_name' => 'Water Tanks',
            'slug' => 'water-tanks',
            'category_image' => null,
        ]);
    }

    public function test_a_non_image_upload_is_rejected(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('category.store'), [
                'category_name' => 'Pumps',
                'meta_title' => 'Pumps',
                'category_image' => UploadedFile::fake()->create('notes.pdf', 10, 'application/pdf'),
            ])
            ->assertSessionHasErrors('category_image');

        $this->assertDatabaseMissing('categories', ['category_name' => 'Pumps']);
    }

    public function test_a_duplicate_category_name_is_rejected(): void
    {
        Category::create([
            'category_name' => 'Water Tanks',
            'slug' => 'water-tanks',
            'meta_title' => 'Water Tanks',
        ]);

        $this->actingAs(User::factory()->create())
            ->post(route('category.store'), [
                'category_name' => 'Water Tanks',
                'meta_title' => 'Water Tanks',
            ])
            ->assertSessionHasErrors('category_name');

        $this->assertDatabaseCount('categories', 1);
    }
}
