<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeContentFrontendTest extends TestCase
{
    public function test_the_hero_and_about_components_fetch_their_api_endpoints(): void
    {
        $hero = file_get_contents(base_path('resources/js/components/HeroSection.vue'));
        $about = file_get_contents(base_path('resources/js/components/AboutSection.vue'));

        $this->assertStringContainsString('/api/home-slides', $hero);
        $this->assertStringContainsString('/api/about', $about);
    }

    public function test_every_hero_fallback_image_exists(): void
    {
        $hero = file_get_contents(base_path('resources/js/components/HeroSection.vue'));
        preg_match_all("#['\"]/images/hero/([^'\"]+)['\"]#", $hero, $matches);

        $this->assertNotEmpty($matches[1]);

        foreach ($matches[1] as $file) {
            $this->assertFileExists(public_path('images/hero/' . $file));
        }
    }

    public function test_the_about_fallback_image_exists(): void
    {
        $this->assertFileExists(
            public_path(ltrim(config('home_content.about.image'), '/'))
        );
    }

    public function test_the_landing_renders_the_contact_section_after_the_faqs(): void
    {
        $welcome = file_get_contents(base_path('resources/js/pages/Welcome.vue'));

        $faqsPosition = strpos($welcome, '<FaqsSection />');
        $contactPosition = strpos($welcome, '<ContactSection />');

        $this->assertNotFalse($faqsPosition);
        $this->assertNotFalse($contactPosition);
        $this->assertGreaterThan($faqsPosition, $contactPosition);
    }
}
