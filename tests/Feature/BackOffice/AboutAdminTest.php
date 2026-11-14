<?php

namespace Tests\Feature\BackOffice;

use App\Models\BackOffice\About;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AboutAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_about_admin_routes(): void
    {
        $this->get(route('edit.about.page'))->assertRedirect(route('login'));
        $this->post(route('update.about'), [])->assertRedirect(route('login'));
    }

    public function test_the_screen_creates_the_row_and_renders_the_effective_defaults(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseCount('abouts', 0);

        $this->actingAs($user)
            ->get(route('edit.about.page'))
            ->assertOk()
            ->assertSee(config('home_content.about.headline'))
            ->assertSee(config('home_content.about.paragraph_one'));

        $this->assertDatabaseCount('abouts', 1);
    }

    public function test_an_admin_can_save_the_homepage_and_about_page_fields(): void
    {
        $user = User::factory()->create();
        $about = About::create(['title' => 'Old']);

        $this->actingAs($user)->post(route('update.about'), [
            'id' => $about->id,
            'title' => 'About title',
            'vision' => 'Vision',
            'mission' => 'Mission',
            'description' => 'Description',
            'section_label' => 'Label',
            'headline' => 'Headline',
            'highlight_word' => 'Highlight',
            'paragraph_one' => 'First paragraph',
            'paragraph_two' => 'Second paragraph',
            'stat_one_number' => '20+',
            'stat_one_label' => 'YEARS',
            'stat_two_number' => '50+',
            'stat_two_label' => 'PROJECTS',
        ])->assertRedirect();

        $this->assertDatabaseHas('abouts', [
            'id' => $about->id,
            'title' => 'About title',
            'vision' => 'Vision',
            'mission' => 'Mission',
            'description' => 'Description',
            'section_label' => 'Label',
            'headline' => 'Headline',
            'highlight_word' => 'Highlight',
            'paragraph_one' => 'First paragraph',
            'paragraph_two' => 'Second paragraph',
            'stat_one_number' => '20+',
            'stat_one_label' => 'YEARS',
            'stat_two_number' => '50+',
            'stat_two_label' => 'PROJECTS',
        ]);
    }

    public function test_saving_without_a_new_image_preserves_the_existing_image(): void
    {
        $user = User::factory()->create();
        $about = About::create([
            'image' => 'upload/about_image/keep.jpg',
            'headline' => 'Old headline',
        ]);

        $this->actingAs($user)->post(route('update.about'), [
            'id' => $about->id,
            'headline' => 'New headline',
        ])->assertRedirect();

        $this->assertDatabaseHas('abouts', [
            'id' => $about->id,
            'headline' => 'New headline',
            'image' => 'upload/about_image/keep.jpg',
        ]);
    }

    public function test_clearing_a_field_falls_back_to_the_default_in_the_api(): void
    {
        $user = User::factory()->create();
        $about = About::create([
            'headline' => 'Custom headline',
            'stat_one_number' => '20+',
        ]);

        $this->actingAs($user)->post(route('update.about'), [
            'id' => $about->id,
            'headline' => '',
            'stat_one_number' => '',
        ])->assertRedirect();

        $this->assertDatabaseHas('abouts', [
            'id' => $about->id,
            'headline' => null,
            'stat_one_number' => null,
        ]);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('headline', config('home_content.about.headline'))
            ->assertJsonPath('stats.0.number', config('home_content.about.stat_one_number'));
    }

    public function test_the_preview_leaves_absolute_image_urls_untouched(): void
    {
        $user = User::factory()->create();
        About::create(['image' => 'https://cdn.example.com/about.jpg']);

        $this->actingAs($user)
            ->get(route('edit.about.page'))
            ->assertOk()
            ->assertSee('src="https://cdn.example.com/about.jpg"', false);
    }

    public function test_uploading_an_about_image_creates_the_directory_and_stores_the_image(): void
    {
        $user = User::factory()->create();
        $about = About::create(['headline' => 'Upload test']);

        $this->actingAs($user)->post(route('update.about'), [
            'id' => $about->id,
            'headline' => 'Upload test',
            'about_image' => UploadedFile::fake()->image('factory.jpg', 669, 499),
        ])->assertRedirect();

        $about->refresh();

        try {
            $this->assertNotNull($about->image);
            $this->assertFileExists(public_path($about->image));
        } finally {
            if ($about->image) {
                @unlink(public_path($about->image));
            }
        }
    }
}
