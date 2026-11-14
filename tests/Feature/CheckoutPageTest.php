<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_page_renders_the_checkout_component(): void
    {
        $this->get('/checkout')->assertOk()->assertSee('checkout-page', false);
    }

    public function test_checkout_component_renders_and_posts_the_honeypot_field(): void
    {
        $component = file_get_contents(base_path('resources/js/components/shop/CheckoutPage.vue'));

        $this->assertStringContainsString('name="hp_field"', $component);
        $this->assertStringContainsString('v-model="form.hp_field"', $component);
        $this->assertStringContainsString('hp_field: form.hp_field', $component);
    }

    public function test_checkout_component_lists_every_validation_error(): void
    {
        $component = file_get_contents(base_path('resources/js/components/shop/CheckoutPage.vue'));

        $this->assertStringContainsString('Object.values(', $component);
        $this->assertStringContainsString('.flat()', $component);
    }

    public function test_confirmation_page_shows_the_order_by_reference(): void
    {
        $order = Order::create([
            'reference' => 'MEK-ABCD1234',
            'customer_name' => 'Jane Doe',
            'customer_email' => 'jane@example.com',
            'customer_phone' => '0712345678',
            'total_amount' => 3000,
            'status' => 'pending',
            'payment_status' => 'pending',
            'shipping_address' => 'Industrial Area, Nairobi',
        ]);

        $this->get('/order/' . $order->reference)
            ->assertOk()
            ->assertSee('MEK-ABCD1234')
            ->assertSee('Jane Doe');
    }

    public function test_unknown_order_reference_returns_not_found(): void
    {
        $this->get('/order/MEK-NOTFOUND')->assertNotFound();
    }
}
