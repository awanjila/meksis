<?php

namespace Tests\Feature;

use App\Models\BackOffice\Faq;
use App\Models\BackOffice\FaqSetting;
use Database\Seeders\FaqSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_seeds_settings_and_six_active_faqs_idempotently(): void
    {
        $this->seed(FaqSeeder::class);
        $this->seed(FaqSeeder::class);

        $this->assertSame(1, FaqSetting::count());
        $this->assertSame(6, Faq::count());
        $this->assertSame(6, Faq::active()->count());
        $this->assertSame(1, Faq::min('sort_order'));
        $this->assertSame(6, Faq::max('sort_order'));
    }
}
