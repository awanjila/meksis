<?php

namespace Tests\Feature\BackOffice;

use App\Models\BackOffice\HomeSlider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class HomeSliderAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_slider_admin_routes(): void
    {
        $this->get(route('index.slider'))->assertRedirect(route('login'));
        $this->get(route('home.slider'))->assertRedirect(route('login'));
        $this->post(route('update.slider'), [])->assertRedirect(route('login'));
    }

    public function test_an_admin_can_update_a_slide_without_a_new_image(): void
    {
        $user = User::factory()->create();
        $slide = HomeSlider::create([
            'title' => 'Old title',
            'short_description' => 'Old description',
            'home_slide' => 'upload/home_slide/keep.jpg',
        ]);

        $this->actingAs($user)->post(route('update.slider'), [
            'id' => $slide->id,
            'title' => 'New title',
            'short_title' => 'New description',
            'video_url' => 'https://example.com/video',
        ])->assertRedirect(route('index.slider'));

        $this->assertDatabaseHas('home_sliders', [
            'id' => $slide->id,
            'title' => 'New title',
            'short_description' => 'New description',
            'video_url' => 'https://example.com/video',
            'home_slide' => 'upload/home_slide/keep.jpg',
        ]);
    }

    public function test_the_slider_list_renders_an_empty_state_hint(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('index.slider'))
            ->assertOk()
            ->assertSee('built-in default hero');
    }

    public function test_slider_forms_do_not_require_an_image(): void
    {
        $user = User::factory()->create();
        $slide = HomeSlider::create([
            'title' => 'Existing',
            'short_description' => 'Existing description',
            'home_slide' => 'upload/home_slide/keep.jpg',
        ]);

        $this->actingAs($user)
            ->get(route('home.slider'))
            ->assertOk()
            ->assertDontSee('Slider Image is required');

        $this->actingAs($user)
            ->get(route('edit.homeslider', $slide->id))
            ->assertOk()
            ->assertDontSee('Slider Image is required');
    }

    public function test_creating_a_slide_without_an_image_persists_the_video_url(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('store.slider'), [
            'title' => 'No image',
            'short_title' => 'No image description',
            'video_url' => 'https://example.com/video',
        ])->assertRedirect(route('index.slider'));

        $this->assertDatabaseHas('home_sliders', [
            'title' => 'No image',
            'short_description' => 'No image description',
            'video_url' => 'https://example.com/video',
            'home_slide' => null,
        ]);
    }

    public function test_slider_upload_rejects_a_non_image_file(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('store.slider'), [
            'title' => 'Bad upload',
            'short_title' => 'Bad upload description',
            'home_slide' => UploadedFile::fake()->create('notes.txt', 10, 'text/plain'),
        ])->assertSessionHasErrors('home_slide');

        $this->assertDatabaseCount('home_sliders', 0);
    }

    public function test_uploading_a_slide_creates_the_directory_and_stores_the_image(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('store.slider'), [
            'title' => 'With image',
            'short_title' => 'With image description',
            'home_slide' => UploadedFile::fake()->image('slide.jpg', 1700, 700),
        ])->assertRedirect(route('index.slider'));

        $slide = HomeSlider::first();

        try {
            $this->assertNotNull($slide);
            $this->assertNotNull($slide->home_slide);
            $this->assertFileExists(public_path($slide->home_slide));
        } finally {
            if ($slide?->home_slide) {
                @unlink(public_path($slide->home_slide));
            }
        }
    }
}
