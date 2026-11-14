<?php

namespace Tests\Feature\BackOffice;

use App\Models\BackOffice\BlogCategory;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BlogStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_can_create_a_blog_without_emailing_anyone(): void
    {
        Mail::fake();
        Contact::create(['name' => 'Subscriber', 'email' => 'subscriber@example.com', 'phone' => '0712345678', 'message' => 'Hi']);

        $category = BlogCategory::create(['name' => 'News']);

        $this->actingAs(User::factory()->create())
            ->post(route('store.blog'), [
                'name' => 'New Post',
                'description' => 'Body text',
                'author' => 'Admin',
                'category' => $category->id,
            ])
            ->assertRedirect(route('index.blog'));

        $this->assertDatabaseHas('blogs', ['name' => 'New Post', 'slug' => 'new-post']);
        Mail::assertNothingSent();
        Mail::assertNothingQueued();
    }
}
