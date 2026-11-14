<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopCatalogueTest extends TestCase
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

    public function test_store_lists_orderable_products(): void
    {
        $this->product();

        $this->get('/store')
            ->assertOk()
            ->assertSee('Steel Tank 10,000L')
            ->assertSee('product-card', false);
    }

    public function test_store_hides_products_without_a_usable_price(): void
    {
        $this->product(['product_name' => 'Free Tank', 'slug' => 'free-tank', 'selling_price' => '0']);
        $this->product(['product_name' => 'Broken Tank', 'slug' => 'broken-tank', 'selling_price' => 'not-a-price']);

        $this->get('/store')
            ->assertOk()
            ->assertDontSee('Free Tank')
            ->assertDontSee('Broken Tank');
    }

    public function test_category_pages_render_only_orderable_products(): void
    {
        $this->product();
        $this->product(['product_name' => 'Free Tank', 'slug' => 'free-tank', 'selling_price' => '0']);

        $this->get('/category/water-tanks')
            ->assertOk()
            ->assertSee('Steel Tank 10,000L')
            ->assertDontSee('Free Tank');

        $this->get('/products/water-tanks')
            ->assertOk()
            ->assertSee('Steel Tank 10,000L')
            ->assertDontSee('Free Tank');
    }

    public function test_product_detail_offers_add_to_cart_for_orderable_products(): void
    {
        $this->product();

        $this->get('/show/product-1/steel-tank-10000l')
            ->assertOk()
            ->assertSee('add-to-cart', false)
            ->assertSee('45000');
    }

    public function test_related_products_hide_non_orderable_products(): void
    {
        $product = $this->product();
        $this->product(['product_name' => 'Free Tank', 'slug' => 'free-tank', 'selling_price' => '0']);

        $this->get('/show/product-1/'.$product->slug)
            ->assertOk()
            ->assertDontSee('Free Tank');
    }

    public function test_cart_page_renders_the_cart_component(): void
    {
        $this->get('/cart')
            ->assertOk()
            ->assertSee('cart-page', false);
    }

    public function test_product_exposes_an_absolute_image_url_and_orderable_flag(): void
    {
        $product = $this->product();

        $this->assertTrue($product->isOrderable());
        $this->assertSame(asset('upload/products/tank.jpg'), $product->image_url);
        $this->assertTrue($product->toArray()['is_orderable']);
    }
}
