<?php

namespace Tests\Feature;

use App\Models\BackOffice\About;
use App\Models\BackOffice\HomeSlider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeContentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_slides_are_ordered_by_id_and_return_absolute_image_urls(): void
    {
        HomeSlider::create([
            'title' => 'Second',
            'short_description' => 'Second description',
            'home_slide' => 'upload/home_slide/b.jpg',
        ]);
        HomeSlider::create([
            'title' => 'First',
            'short_description' => 'First description',
            'home_slide' => 'upload/home_slide/a.jpg',
        ]);

        $this->getJson('/api/home-slides')
            ->assertOk()
            ->assertJsonCount(2, 'slides')
            ->assertJsonPath('slides.0.id', 1)
            ->assertJsonPath('slides.0.title', 'Second')
            ->assertJsonPath('slides.0.description', 'Second description')
            ->assertJsonPath('slides.0.image', asset('upload/home_slide/b.jpg'))
            ->assertJsonPath('slides.1.id', 2)
            ->assertJsonPath('slides.1.image', asset('upload/home_slide/a.jpg'));
    }

    public function test_slides_return_an_empty_array_when_the_table_is_empty(): void
    {
        $this->getJson('/api/home-slides')
            ->assertOk()
            ->assertJsonCount(0, 'slides');
    }

    public function test_slides_return_a_null_image_when_the_slide_has_none(): void
    {
        HomeSlider::create(['title' => 'No image', 'short_description' => 'Text']);

        $this->getJson('/api/home-slides')
            ->assertOk()
            ->assertJsonPath('slides.0.image', null);
    }

    public function test_about_returns_the_configured_defaults_when_no_row_exists(): void
    {
        $this->assertDatabaseCount('abouts', 0);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('section_label', config('home_content.about.section_label'))
            ->assertJsonPath('headline', config('home_content.about.headline'))
            ->assertJsonPath('highlight_word', config('home_content.about.highlight_word'))
            ->assertJsonPath('paragraph_one', config('home_content.about.paragraph_one'))
            ->assertJsonPath('paragraph_two', config('home_content.about.paragraph_two'))
            ->assertJsonPath('image', asset(config('home_content.about.image')))
            ->assertJsonPath('stats.0.number', '15+')
            ->assertJsonPath('stats.0.label', 'YEARS EXPERIENCE')
            ->assertJsonPath('stats.1.number', '1000+')
            ->assertJsonPath('stats.1.label', 'HAPPY CLIENTS');
    }

    public function test_about_prefers_stored_values_including_image_and_stats(): void
    {
        About::create([
            'section_label' => 'CUSTOM LABEL',
            'headline' => 'CUSTOM HEADLINE',
            'highlight_word' => 'CUSTOM',
            'paragraph_one' => 'One',
            'paragraph_two' => 'Two',
            'stat_one_number' => '20+',
            'stat_one_label' => 'YEARS',
            'stat_two_number' => '50+',
            'stat_two_label' => 'PROJECTS',
            'image' => 'upload/about_image/factory.jpg',
        ]);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('section_label', 'CUSTOM LABEL')
            ->assertJsonPath('headline', 'CUSTOM HEADLINE')
            ->assertJsonPath('highlight_word', 'CUSTOM')
            ->assertJsonPath('paragraph_one', 'One')
            ->assertJsonPath('paragraph_two', 'Two')
            ->assertJsonPath('image', asset('upload/about_image/factory.jpg'))
            ->assertJsonPath('stats.0.number', '20+')
            ->assertJsonPath('stats.0.label', 'YEARS')
            ->assertJsonPath('stats.1.number', '50+')
            ->assertJsonPath('stats.1.label', 'PROJECTS');
    }

    public function test_about_falls_back_per_field_when_a_stored_value_is_null(): void
    {
        About::create([
            'headline' => null,
            'stat_one_number' => null,
            'image' => null,
        ]);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('headline', config('home_content.about.headline'))
            ->assertJsonPath('stats.0.number', '15+')
            ->assertJsonPath('image', asset(config('home_content.about.image')));
    }

    public function test_about_leaves_absolute_image_urls_untouched(): void
    {
        About::create(['image' => 'https://cdn.example.com/about.jpg']);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('image', 'https://cdn.example.com/about.jpg');
    }
}
