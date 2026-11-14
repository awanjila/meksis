<?php

namespace Tests\Feature\BackOffice;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_order_admin_routes(): void
    {
        $this->get(route('orders.index'))->assertRedirect(route('login'));
        $this->get(route('orders.show', 1))->assertRedirect(route('login'));
        $this->post(route('orders.status', 1), [])->assertRedirect(route('login'));
    }

    public function test_an_admin_sees_the_order_list_and_detail(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'reference' => 'MEK-TEST1234',
            'customer_name' => 'Jane Doe',
            'customer_email' => 'jane@example.com',
            'customer_phone' => '0712345678',
            'total_amount' => 3000,
            'status' => 'pending',
            'payment_status' => 'pending',
            'shipping_address' => 'Industrial Area, Nairobi',
        ]);

        $this->actingAs($user)->get(route('orders.index'))
            ->assertOk()->assertSee('MEK-TEST1234')->assertSee('Jane');

        $this->actingAs($user)->get(route('orders.show', $order))
            ->assertOk()->assertSee('MEK-TEST1234');
    }

    public function test_an_admin_can_update_order_status(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'reference' => 'MEK-TEST1234',
            'customer_name' => 'Jane Doe',
            'customer_email' => 'jane@example.com',
            'customer_phone' => '0712345678',
            'total_amount' => 3000,
            'status' => 'pending',
            'payment_status' => 'pending',
            'shipping_address' => 'Industrial Area, Nairobi',
        ]);

        $this->actingAs($user)->post(route('orders.status', $order), [
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ])->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);
    }

    public function test_invalid_status_is_rejected(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'reference' => 'MEK-TEST1234',
            'customer_name' => 'Jane Doe',
            'customer_email' => 'jane@example.com',
            'customer_phone' => '0712345678',
            'total_amount' => 3000,
            'status' => 'pending',
            'payment_status' => 'pending',
            'shipping_address' => 'Industrial Area, Nairobi',
        ]);

        $this->actingAs($user)->post(route('orders.status', $order), [
            'status' => 'shipped',
            'payment_status' => 'pending',
        ])->assertSessionHasErrors('status');
    }
}
