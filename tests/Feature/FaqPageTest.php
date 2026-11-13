<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_faqs_page_loads_the_vue_component(): void
    {
        $this->get('/faqs')
            ->assertOk()
            ->assertSee('<faqs-page></faqs-page>', false);
    }
}
