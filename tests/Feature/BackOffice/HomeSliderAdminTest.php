<?php

namespace Tests\Feature\BackOffice;

use App\Models\BackOffice\HomeSlider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
