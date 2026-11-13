<?php

namespace Tests\Feature;

use App\Models\BackOffice\Faq;
use App\Models\BackOffice\FaqSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_settings_row_is_created_once(): void
    {
        $settings = FaqSetting::current();

        $this->assertSame(1, $settings->id);
        $this->assertSame('FREQUENTLY ASKED QUESTIONS', $settings->title);
        $this->assertSame(1, FaqSetting::count());
        $this->assertSame($settings->id, FaqSetting::current()->id);
    }

    public function test_ordered_scope_uses_sort_order_then_id(): void
    {
        Faq::create(['question' => 'Third', 'answer' => 'c', 'sort_order' => 2]);
        Faq::create(['question' => 'Second', 'answer' => 'b', 'sort_order' => 1]);
        Faq::create(['question' => 'First', 'answer' => 'a', 'sort_order' => 1]);

        $this->assertSame(
            ['Second', 'First', 'Third'],
            Faq::ordered()->pluck('question')->all()
        );
    }

    public function test_active_scope_excludes_inactive_faqs(): void
    {
        Faq::create(['question' => 'Visible', 'answer' => 'a', 'is_active' => true]);
        Faq::create(['question' => 'Hidden', 'answer' => 'b', 'is_active' => false]);

        $this->assertSame(['Visible'], Faq::active()->pluck('question')->all());
    }
}
