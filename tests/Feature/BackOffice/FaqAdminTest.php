<?php

namespace Tests\Feature\BackOffice;

use App\Models\BackOffice\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_admin_faq_routes(): void
    {
        $this->get(route('faq.index'))->assertRedirect(route('login'));
    }

    public function test_admin_can_view_faq_screens(): void
    {
        $user = User::factory()->create();
        Faq::create(['question' => 'Q1', 'answer' => 'A1']);

        $this->actingAs($user)->get(route('faq.index'))->assertOk()->assertSee('Q1');
        $this->actingAs($user)->get(route('faq.add'))->assertOk();
        $this->actingAs($user)->get(route('faq.edit', 1))->assertOk()->assertSee('A1');
        $this->actingAs($user)->get(route('faq.settings'))->assertOk();
    }

    public function test_admin_can_create_a_faq(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('faq.store'), [
            'question' => 'Do you install?',
            'answer' => 'Yes, across Kenya.',
            'sort_order' => 3,
            'is_active' => '1',
        ])->assertRedirect(route('faq.index'));

        $this->assertDatabaseHas('faqs', [
            'question' => 'Do you install?',
            'sort_order' => 3,
            'is_active' => true,
        ]);
    }

    public function test_blank_sort_order_appends_to_the_end(): void
    {
        $user = User::factory()->create();
        Faq::create(['question' => 'Existing', 'answer' => 'A', 'sort_order' => 4]);

        $this->actingAs($user)->post(route('faq.store'), [
            'question' => 'New',
            'answer' => 'B',
            'sort_order' => '',
        ])->assertRedirect(route('faq.index'));

        $this->assertDatabaseHas('faqs', ['question' => 'New', 'sort_order' => 5]);
    }

    public function test_admin_validation_rejects_missing_fields(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('faq.store'), [
            'question' => '',
            'answer' => '',
        ])->assertSessionHasErrors(['question', 'answer']);

        $this->assertDatabaseCount('faqs', 0);
    }

    public function test_admin_can_update_and_deactivate_a_faq(): void
    {
        $user = User::factory()->create();
        $faq = Faq::create(['question' => 'Old', 'answer' => 'Old answer', 'sort_order' => 1]);

        $this->actingAs($user)->post(route('faq.update'), [
            'id' => $faq->id,
            'question' => 'New',
            'answer' => 'New answer',
            'sort_order' => 2,
        ])->assertRedirect(route('faq.index'));

        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'question' => 'New',
            'sort_order' => 2,
            'is_active' => false,
        ]);
    }

    public function test_admin_can_delete_a_faq(): void
    {
        $user = User::factory()->create();
        $faq = Faq::create(['question' => 'Delete me', 'answer' => 'A']);

        $this->actingAs($user)
            ->get(route('faq.delete', $faq->id))
            ->assertRedirect();

        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);
    }

    public function test_admin_can_update_faq_settings(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('faq.settings.update'), [
            'title' => 'QUESTIONS',
            'subtitle' => 'Answers',
        ])->assertRedirect();

        $this->assertDatabaseHas('faq_settings', [
            'id' => 1,
            'title' => 'QUESTIONS',
            'subtitle' => 'Answers',
        ]);
    }
}
