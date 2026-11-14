<?php

namespace Tests\Feature\BackOffice;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductDeleteGuardTest extends TestCase
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

    public function test_a_product_used_in_an_order_cannot_be_deleted(): void
    {
        $user = User::factory()->create();
        $product = $this->product();
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
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'unit_price' => 1500,
            'subtotal' => 1500,
        ]);

        $this->actingAs($user)->get(route('delete.product', $product->id))
            ->assertRedirect();

        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_an_unused_product_can_still_be_deleted(): void
    {
        $user = User::factory()->create();
        $product = $this->product();

        $this->actingAs($user)->get(route('delete.product', $product->id))
            ->assertRedirect();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
