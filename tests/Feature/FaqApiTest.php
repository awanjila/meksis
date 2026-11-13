<?php

namespace Tests\Feature;

use App\Models\BackOffice\Faq;
use App\Models\BackOffice\FaqSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_settings_title_subtitle_and_only_active_faqs_ordered(): void
    {
        FaqSetting::current()->update(['title' => 'QUESTIONS', 'subtitle' => 'Answers']);

        Faq::create(['question' => 'Later', 'answer' => 'b', 'sort_order' => 2]);
        Faq::create(['question' => 'First tie', 'answer' => 'a', 'sort_order' => 1]);
        Faq::create(['question' => 'Second tie', 'answer' => 'a2', 'sort_order' => 1]);
        Faq::create(['question' => 'Hidden', 'answer' => 'x', 'sort_order' => 0, 'is_active' => false]);

        $response = $this->getJson('/api/faqs');

        $response->assertOk()
            ->assertJsonPath('title', 'QUESTIONS')
            ->assertJsonPath('subtitle', 'Answers')
            ->assertJsonCount(3, 'faqs')
            ->assertJsonPath('faqs.0.question', 'First tie')
            ->assertJsonPath('faqs.1.question', 'Second tie')
            ->assertJsonPath('faqs.2.question', 'Later');

        $this->assertStringNotContainsString('Hidden', $response->getContent());
    }

    public function test_it_limits_results(): void
    {
        foreach (range(1, 8) as $i) {
            Faq::create(['question' => "Q{$i}", 'answer' => "A{$i}", 'sort_order' => $i]);
        }

        $this->getJson('/api/faqs?limit=6')
            ->assertOk()
            ->assertJsonCount(6, 'faqs');
    }

    public function test_it_returns_empty_faq_list_when_none_are_active(): void
    {
        Faq::create(['question' => 'Hidden', 'answer' => 'x', 'is_active' => false]);

        $this->getJson('/api/faqs')
            ->assertOk()
            ->assertJsonCount(0, 'faqs');
    }

    public function test_it_falls_back_to_default_settings_when_row_is_missing(): void
    {
        $this->assertDatabaseCount('faq_settings', 0);

        $this->getJson('/api/faqs')
            ->assertOk()
            ->assertJsonPath('title', 'FREQUENTLY ASKED QUESTIONS');
    }

    public function test_it_rejects_invalid_limit_values(): void
    {
        $this->getJson('/api/faqs?limit=0')->assertStatus(422);
        $this->getJson('/api/faqs?limit=51')->assertStatus(422);
        $this->getJson('/api/faqs?limit=abc')->assertStatus(422);
    }

    public function test_it_rejects_invalid_limit_values_for_non_json_requests(): void
    {
        $this->get('/api/faqs?limit=0')->assertStatus(422);
    }
}
