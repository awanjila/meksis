<?php

namespace Tests\Feature;

use App\Mail\NewOrderNotification;
use App\Mail\OrderConfirmation;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    private function category(): Category
    {
        return Category::firstOrCreate(
            ['slug' => 'water-tanks'],
            ['category_name' => 'Water Tanks', 'meta_title' => 'Water Tanks']
        );
    }

    private function product(array $overrides = []): Product
    {
        return Product::create(array_merge([
            'product_name' => 'Steel Tank 10,000L',
            'meta_title' => 'Steel Tank',
            'meta_description' => 'A steel tank',
            'slug' => 'steel-tank-10000l',
            'category_id' => $this->category()->id,
            'brand_id' => 1,
            'supplier_id' => 1,
            'product_code' => 'MEK001',
            'product_image' => 'upload/products/tank.jpg',
            'product_store' => '5',
            'selling_price' => '45000',
            'product_description' => 'Description',
            'product_features' => 'Features',
        ], $overrides));
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '0712345678',
            'company' => 'Acme Ltd',
            'address' => 'Industrial Area, Nairobi',
            'notes' => 'Call before delivery',
            'items' => [['id' => $this->product()->id, 'quantity' => 2]],
            'hp_field' => '',
        ], $overrides);
    }

    public function test_checkout_creates_an_order_with_server_side_prices(): void
    {
        Mail::fake();
        $product = $this->product(['selling_price' => '1500', 'product_store' => '10']);

        $response = $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 2, 'unit_price' => 1, 'price' => 1]],
        ]));

        $response->assertCreated()
            ->assertJsonPath('success', true)
            ->assertJsonPath('email', 'jane@example.com');

        $this->assertMatchesRegularExpression('/^MEK-[A-Z0-9]{8}$/', $response->json('reference'));

        $order = Order::first();
        $this->assertSame('3000.00', number_format((float) $order->total_amount, 2, '.', ''));
        $this->assertSame('pending', $order->status);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'unit_price' => 1500,
            'subtotal' => 3000,
        ]);
        $this->assertSame('8', $product->fresh()->product_store);

        Mail::assertSent(OrderConfirmation::class, fn ($mail) => $mail->hasTo('jane@example.com'));
        Mail::assertSent(NewOrderNotification::class, fn ($mail) => $mail->hasTo('info@meksis.co.ke'));
    }

    public function test_checkout_ignores_client_supplied_prices(): void
    {
        Mail::fake();
        $product = $this->product(['selling_price' => '1500']);

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 1, 'unit_price' => 0.01]],
        ]))->assertCreated();

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'unit_price' => 1500,
            'subtotal' => 1500,
        ]);
    }

    public function test_checkout_rejects_unorderable_products(): void
    {
        Mail::fake();
        $product = $this->product(['selling_price' => '0']);

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 1]],
        ]))->assertStatus(422)->assertJsonValidationErrors('items');

        $this->assertDatabaseCount('orders', 0);
    }

    public function test_checkout_does_not_take_stock_below_zero(): void
    {
        Mail::fake();
        $product = $this->product(['product_store' => '1']);

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 2]],
        ]))->assertCreated();

        $this->assertSame('1', $product->fresh()->product_store);
    }

    public function test_checkout_keeps_the_order_when_mail_fails(): void
    {
        Mail::shouldReceive('to')->andThrow(new \RuntimeException('smtp down'));
        $product = $this->product();

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 1]],
        ]))->assertCreated();

        $this->assertDatabaseCount('orders', 1);
    }

    public function test_checkout_validates_contact_items_and_quantities(): void
    {
        $this->postJson('/api/orders', [
            'name' => '',
            'email' => 'not-an-email',
            'phone' => '',
            'address' => '',
            'items' => [],
        ])->assertStatus(422)->assertJsonValidationErrors(['name', 'email', 'phone', 'address', 'items']);

        $product = $this->product();
        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 0]],
        ]))->assertStatus(422)->assertJsonValidationErrors('items.0.quantity');

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 100]],
        ]))->assertStatus(422)->assertJsonValidationErrors('items.0.quantity');
    }

    public function test_checkout_rejects_unknown_products_without_creating_an_order(): void
    {
        Mail::fake();

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => 999999, 'quantity' => 1]],
        ]))->assertStatus(422)->assertJsonValidationErrors('items');

        $this->assertDatabaseCount('orders', 0);
        Mail::assertNothingSent();
    }

    public function test_checkout_rejects_duplicate_product_ids_without_creating_an_order(): void
    {
        Mail::fake();
        $product = $this->product();

        $this->postJson('/api/orders', $this->payload([
            'items' => [
                ['id' => $product->id, 'quantity' => 1],
                ['id' => $product->id, 'quantity' => 2],
            ],
        ]))->assertStatus(422)->assertJsonValidationErrors('items.1.id');

        $this->assertDatabaseCount('orders', 0);
        $this->assertSame('5', $product->fresh()->product_store);
    }

    public function test_checkout_rechecks_orderability_under_lock(): void
    {
        Mail::fake();
        $product = $this->product();

        Product::retrieved(function () use ($product) {
            DB::table('products')->where('id', $product->id)->update(['selling_price' => '0']);
            Product::flushEventListeners();
        });

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 1]],
        ]))->assertStatus(422)->assertJsonValidationErrors('items');

        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('order_items', 0);
        $this->assertSame('5', $product->fresh()->product_store);
    }

    public function test_checkout_rolls_back_when_product_is_deleted_under_lock(): void
    {
        Mail::fake();
        $product = $this->product();

        Product::retrieved(function () use ($product) {
            DB::table('products')->where('id', $product->id)->delete();
            Product::flushEventListeners();
        });

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 1]],
        ]))->assertStatus(422)->assertJsonValidationErrors('items');

        $this->assertDatabaseCount('orders', 0);
        $this->assertDatabaseCount('order_items', 0);
    }

    public function test_checkout_treats_non_numeric_stock_as_zero(): void
    {
        Mail::fake();
        $product = $this->product(['product_store' => 'n/a']);

        $this->postJson('/api/orders', $this->payload([
            'items' => [['id' => $product->id, 'quantity' => 2]],
        ]))->assertCreated();

        $this->assertDatabaseCount('orders', 1);
        $this->assertSame('n/a', $product->fresh()->product_store);
    }

    public function test_honeypot_returns_success_without_creating_an_order(): void
    {
        Mail::fake();
        $product = $this->product();

        $this->postJson('/api/orders', $this->payload([
            'hp_field' => 'spam',
            'items' => [['id' => $product->id, 'quantity' => 1]],
        ]))->assertCreated()->assertJsonPath('success', true);

        $this->assertDatabaseCount('orders', 0);
        Mail::assertNothingSent();
    }
}
