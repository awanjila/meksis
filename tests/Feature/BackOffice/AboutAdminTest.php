<?php

namespace Tests\Feature\BackOffice;

use App\Models\BackOffice\About;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
