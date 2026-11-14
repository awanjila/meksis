# Front-end Shop, Cart Page, and Email Checkout Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Turn the back-office product catalogue into a front-end shop with a cart page and guest checkout that saves orders and emails the customer plus `info@meksis.co.ke`.

**Architecture:** Laravel 10 controllers return Blade shop pages; Vue 3 components (Pinia cart) handle the interactive cart and checkout. `POST /api/orders` recalculates prices from `products`, writes `orders` + `order_items` in a transaction, then sends two markdown emails. A small `BackOffice` screen manages order status.

**Tech Stack:** Laravel 10, PHP 8.1, Vue 3 (Options API), Pinia, Vite, PHPUnit, SQLite in-memory tests.

**Spec:** `docs/superpowers/specs/2026-11-14-shop-checkout-design.md`

## Global Constraints

- No new Composer or npm dependencies.
- Guest checkout only; no online payments, customer login, coupons, shipping fees, or tax.
- **Do not modify the front-end PRODUCTS/services dropdown in `Header.vue`.** Its `/api/services` data, links, and markup stay exactly as they are. The shop is a separate area that reads the `Product` model. Header work is limited to adding the SHOP link and cart icon.
- Business notification address: `info@meksis.co.ke`, read through `config('shop.notification_email')` (`SHOP_NOTIFICATION_EMAIL`), default `info@meksis.co.ke`.
- Server-side prices only: `unit_price` comes from `products.selling_price`; never from the request.
- A product is orderable only when `selling_price` is numeric and greater than zero. Stock never blocks an order and never goes below zero.
- Tests use SQLite `:memory:`, `RefreshDatabase`, and `Mail::fake()`.
- Design tokens: `--royal-yellow: rgb(250, 218, 94)`, `--charcoal: rgb(26, 26, 26)`, square corners, uppercase Arial Narrow headings.
- Follow existing patterns: `admin.admin_master` layout, notification flash arrays, markdown mailables.
- Do not commit `storage/logs/laravel.log`.
- On Windows use `npm.cmd run build`; a PowerShell exit code of 1 can still mean Vite succeeded, so check the output/manifest.
- Commit `public/build` with the final task, consistent with the previous release.

## Review Focus

- A forged or stale price in the checkout request must never change the order total. Tested in Task 3 (`test_checkout_ignores_client_supplied_prices`).
- Deleting a product that appears in an order must not erase that order's lines. Tested in Task 5 (`test_a_product_used_in_an_order_cannot_be_deleted`).
- A product with a missing, zero, or non-numeric price must never become a free order. Tested in Task 1 (`test_store_hides_products_without_a_usable_price`) and Task 3 (`test_checkout_rejects_unorderable_products`).
- An SMTP failure after a successful transaction must leave the order saved and still return success. Tested in Task 3 (`test_checkout_keeps_the_order_when_mail_fails`).
- An empty cart, unknown product, or quantity outside 1–99 must return a clear 422 and create nothing. Tested in Task 3 (`test_checkout_validates_contact_items_and_quantities`).

---

### Task 1: Orderable catalogue and shop index

**Files:**
- Modify: `app/Models/Product.php`
- Modify: `app/Http/Controllers/CatalogController.php`
- Create: `resources/views/client/shop/index.blade.php`
- Create: `resources/js/components/shop/ProductCard.vue`
- Modify: `resources/js/app.js`
- Modify: `resources/js/components/shop/AddToCart.vue`
- Modify: `resources/views/client/shop/shop_product.blade.php:56`
- Test: `tests/Feature/ShopCatalogueTest.php`

**Interfaces:**
- Consumes: `App\Models\Product`, `App\Models\Category`.
- Produces:
  - `Product::isOrderable(): bool` — true when `is_numeric($this->selling_price) && (float) $this->selling_price > 0`.
  - `Product::getImageUrlAttribute(): string` — `$this->product_image ? asset($this->product_image) : ''`.
  - `Product::$appends = ['image_url', 'is_orderable']`.
  - `CatalogController@index(): \Illuminate\View\View` — view `client.shop.index`, variables `$products` (orderable collection) and `$categories`.
  - `CatalogController@showProducts(string $slug): \Illuminate\View\View` — delegates to `showByCategory`.
  - `ProductCard.vue` prop `product: Object` with fields `id`, `product_name`, `slug`, `selling_price`, `image_url`, `is_orderable`.

- [ ] **Step 1: Write the failing catalogue tests**

Create `tests/Feature/ShopCatalogueTest.php`:

```php
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
        return Category::create([
            'category_name' => 'Water Tanks',
            'meta_title' => 'Water Tanks',
            'slug' => 'water-tanks',
        ]);
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

    public function test_product_exposes_an_absolute_image_url_and_orderable_flag(): void
    {
        $product = $this->product();

        $this->assertTrue($product->isOrderable());
        $this->assertSame(asset('upload/products/tank.jpg'), $product->image_url);
        $this->assertTrue($product->toArray()['is_orderable']);
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test tests/Feature/ShopCatalogueTest.php`
Expected: FAIL — `/store` errors because `CatalogController@index` is missing, and `image_url`/`is_orderable` do not exist.

- [ ] **Step 3: Add the orderable/price/image behaviour to `Product`**

In `app/Models/Product.php`, add `protected $appends = ['image_url', 'is_orderable'];` and:

```php
public function isOrderable(): bool
{
    return is_numeric($this->selling_price) && (float) $this->selling_price > 0;
}

public function getImageUrlAttribute(): string
{
    return $this->product_image ? asset($this->product_image) : '';
}
```

Keep `selling_price` as-is (string column).

- [ ] **Step 4: Implement the shop controller actions**

In `app/Http/Controllers/CatalogController.php`:

- Rename the class to `CatalogController` (same file).
- Add `use Illuminate\View\View;`.
- Add:

```php
public function index(): View
{
    $products = Product::with('category')
        ->latest()
        ->get()
        ->filter(fn (Product $product) => $product->isOrderable())
        ->values();

    $categories = Category::orderBy('category_name')->get();

    return view('client.shop.index', compact('products', 'categories'));
}

public function showProducts(string $slug): View
{
    return $this->showByCategory($slug);
}
```

In the existing `showByCategory`, keep the category lookup and view, but filter the products through the same orderable rule so a zero-price product never appears in a shop category listing:

```php
$items = Product::where('category_id', $category->id)
    ->get()
    ->filter(fn (Product $product) => $product->isOrderable())
    ->values();
```

Leave `show` otherwise unchanged.

- [ ] **Step 5: Create the shop page and product card**

Create `resources/views/client/shop/index.blade.php` extending `client.layout.app` with:

- `rs-breadcrumbs` title "Shop" and Home / Shop breadcrumbs.
- A row of category links: `<a href="{{ route('category.products', $category->slug) }}">{{ $category->category_name }}</a>` plus a "Shop all" link to `/store`.
- An `rs-shop-part` section containing `<div class="row">` and `@foreach($products as $product) <product-card :product='@json($product)'></product-card> @endforeach`.
- An empty state when `$products->isEmpty()`: "No products are available yet."

Create `resources/js/components/shop/ProductCard.vue` (Options API, matching the existing shop components):

```vue
<template>
  <div class="col-lg-4 col-md-6 mb-80">
    <div class="product-list">
      <div class="image-product">
        <a :href="`/show/product-1/${product.slug}`">
          <img :src="product.image_url" :alt="product.product_name">
        </a>
      </div>
      <div class="content-desc text-center">
        <h2 class="loop-product-title pt-15">
          <a :href="`/show/product-1/${product.slug}`">{{ product.product_name }}</a>
        </h2>
        <span class="price">Ksh {{ product.selling_price }}</span>
        <add-to-cart v-if="product.is_orderable" :product="product"></add-to-cart>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductCard',
  props: {
    product: { type: Object, required: true }
  }
}
</script>
```

Register it in `resources/js/app.js` next to the other shop components:

```js
import ProductCard from './components/shop/ProductCard.vue';
app.component('product-card', ProductCard);
```

- [ ] **Step 6: Use the absolute image URL in the cart and hide the button for non-orderable products**

In `resources/js/components/shop/AddToCart.vue`, change the cart item's `image` to `props.product.image_url || props.product.product_image`.

In `resources/views/client/shop/shop_product.blade.php`, wrap the existing `<add-to-cart>` line (line 56) with `@if($product->isOrderable()) ... @endif`.

- [ ] **Step 7: Run the tests to verify they pass**

Run: `php artisan test tests/Feature/ShopCatalogueTest.php`
Expected: PASS (5 tests).

- [ ] **Step 8: Commit**

```bash
git add app/Models/Product.php app/Http/Controllers/CatalogController.php resources/views/client/shop/index.blade.php resources/views/client/shop/shop_product.blade.php resources/js/components/shop/ProductCard.vue resources/js/components/shop/AddToCart.vue resources/js/app.js tests/Feature/ShopCatalogueTest.php
git commit -m "feat: add orderable product catalogue and shop index"
```

---

### Task 2: Cart page and header shop links

**Files:**
- Modify: `app/Http/Controllers/CatalogController.php`
- Create: `resources/views/client/shop/cart.blade.php`
- Create: `resources/js/components/shop/CartPage.vue`
- Create: `resources/js/components/shop/CartLink.vue`
- Delete: `resources/js/components/shop/Cart.vue`
- Delete: `resources/js/components/shop/Checkout.vue`
- Delete: `resources/js/components/shop/CartToggle.vue`
- Modify: `resources/js/app.js`
- Modify: `resources/js/components/layout/Header.vue`
- Modify: `routes/web.php`
- Test: `tests/Feature/ShopCatalogueTest.php`

**Interfaces:**
- Consumes: `resources/js/store/cart.js` (`useCartStore`, `cartItems`, `cartTotal`, `itemCount`, `updateQuantity`, `removeFromCart`).
- Produces:
  - `CatalogController@showCart(): \Illuminate\View\View` — view `client.shop.cart`.
  - `CartPage.vue` — no props; renders `cart-page` and links to `/checkout`.
  - `CartLink.vue` — no props; renders `cart-link` and links to `/cart`.
  - Header changes are limited to the SHOP link and cart icon. The PRODUCTS/services dropdown is untouched.

- [ ] **Step 1: Write the failing cart-page test**

Add to `tests/Feature/ShopCatalogueTest.php`:

```php
public function test_cart_page_renders_the_cart_component(): void
{
    $this->get('/cart')
        ->assertOk()
        ->assertSee('cart-page', false);
}
```

- [ ] **Step 2: Run it to verify it fails**

Run: `php artisan test tests/Feature/ShopCatalogueTest.php --filter=cart_page`
Expected: FAIL with a 500 because `CatalogController@showCart` is missing.

- [ ] **Step 3: Add the cart controller action and Blade page**

In `CatalogController`, add:

```php
public function showCart(): View
{
    return view('client.shop.cart');
}
```

Create `resources/views/client/shop/cart.blade.php` with a breadcrumb (Home / Cart), an `rs-shop-part` section, and `<cart-page></cart-page>`.

In `routes/web.php`, inside the existing `Route::controller(CatalogController::class)` group, change the cart route path from `show/cart` to `cart` so it matches the design:

```php
Route::get('cart', 'showCart')->name('show.cart');
```

Leave the other route declarations (`/store`, `/category/{slug}`, `/products/{slug}`, `/show/product-1/{slug}`, `/checkout`) exactly as they are.

- [ ] **Step 4: Build `CartPage.vue`**

Create `resources/js/components/shop/CartPage.vue` (Options API, `setup()` using `useCartStore`):

- Empty state with a cart icon, "Your cart is empty", and a link to `/store`.
- Line items: image, name, unit price, quantity buttons (`item.quantity - 1` / `+ 1`, minimum 1), remove button.
- Subtotal row: `Ksh {{ cartTotal }}`.
- "Proceed to Checkout" link to `/checkout`.
- Scoped styles using the royal-yellow accent for the checkout button, charcoal text, square corners.

- [ ] **Step 5: Build `CartLink.vue` and wire the header**

Create `resources/js/components/shop/CartLink.vue`:

```vue
<template>
  <a href="/cart" class="cart-link" aria-label="Cart">
    <font-awesome-icon :icon="['fas', 'shopping-cart']" />
    <span v-if="itemCount > 0" class="cart-count">{{ itemCount }}</span>
  </a>
</template>

<script>
import { computed } from 'vue';
import { useCartStore } from '../../store/cart';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';

library.add(faShoppingCart);

export default {
  name: 'CartLink',
  setup() {
    const cartStore = useCartStore();
    return { itemCount: computed(() => cartStore.itemCount) };
  }
}
</script>
```

In `resources/js/app.js`:

- Replace the imports/registrations for `Cart`, `Checkout`, and `CartToggle` with `CartPage` (`cart-page`), `CheckoutPage` is added in Task 4, and `CartLink` (`cart-link`). For this task only import `CartPage` and `CartLink`; leave a comment that `CheckoutPage` arrives in Task 4.
- Delete `resources/js/components/shop/Cart.vue`, `Checkout.vue`, and `CartToggle.vue` with `git rm`.

In `resources/js/components/layout/Header.vue`:

- Desktop nav: add `<a href="/store" class="nav-link">SHOP</a>` before the PRODUCTS dropdown.
- Add `<cart-link></cart-link>` after `</nav>` and before the mobile toggle button.
- Mobile nav: add `<a href="/store" class="mobile-nav-link">SHOP</a>` and `<a href="/cart" class="mobile-nav-link">CART</a>` above the mobile CTA buttons.
- Add scoped styles for `.cart-link` and `.cart-count` (count badge in royal yellow or charcoal, square).
- **Do not touch the PRODUCTS dropdown.** Leave `services`, `servicesLoading`, `fetchServices()`, `/api/services`, and its existing links exactly as they are. No `categories` data, no dropdown markup changes, no "SHOP ALL" entry in the dropdown.

- [ ] **Step 6: Run the tests to verify they pass**

Run: `php artisan test tests/Feature/ShopCatalogueTest.php`
Expected: PASS (6 tests).

- [ ] **Step 7: Commit**

```bash
git add app/Http/Controllers/CatalogController.php resources/views/client/shop/cart.blade.php resources/js/components/shop/CartPage.vue resources/js/components/shop/CartLink.vue resources/js/components/layout/Header.vue resources/js/app.js routes/web.php tests/Feature/ShopCatalogueTest.php
git rm resources/js/components/shop/Cart.vue resources/js/components/shop/Checkout.vue resources/js/components/shop/CartToggle.vue
git commit -m "feat: add cart page and header shop links"
```

---

### Task 3: Orders schema, models, emails, and the order API

**Files:**
- Create: `database/migrations/2026_11_14_000001_add_checkout_fields_to_orders_table.php`
- Create: `app/Models/OrderItem.php`
- Modify: `app/Models/Order.php`
- Create: `config/shop.php`
- Create: `app/Mail/OrderConfirmation.php`
- Create: `app/Mail/NewOrderNotification.php`
- Create: `resources/views/emails/orderConfirmation.blade.php`
- Create: `resources/views/emails/orderNotification.blade.php`
- Create: `app/Http/Controllers/Api/OrderController.php`
- Modify: `routes/api.php`
- Modify: `.env.example`
- Test: `tests/Feature/OrderApiTest.php`

**Interfaces:**
- Consumes: `Product::isOrderable()`, `Order`, `OrderItem`, `config('shop.notification_email')`.
- Produces:
  - `orders` gains `reference` (unique, nullable), `customer_name`, `customer_email`, `customer_phone`, `company`.
  - `OrderItem` fillable: `order_id`, `product_id`, `quantity`, `unit_price`, `subtotal`; `order()` and `product()` relations.
  - `Order` fillable gains the new fields; `items()` already returns `hasMany(OrderItem::class)`.
  - `OrderConfirmation::__construct(Order $order)` and `NewOrderNotification::__construct(Order $order)`.
  - `Api\OrderController@store(Request $request): \Illuminate\Http\JsonResponse` — `201 { success, reference, email }` or `422`.
  - `POST /api/orders` with `throttle:10,1`.

- [ ] **Step 1: Write the failing order API tests**

Create `tests/Feature/OrderApiTest.php` with `RefreshDatabase`, a `category()` and `product($overrides)` helper copied from Task 1, and:

```php
use App\Mail\NewOrderNotification;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

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
        'website' => '',
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

public function test_honeypot_returns_success_without_creating_an_order(): void
{
    Mail::fake();
    $product = $this->product();

    $this->postJson('/api/orders', $this->payload([
        'website' => 'spam',
        'items' => [['id' => $product->id, 'quantity' => 1]],
    ]))->assertCreated()->assertJsonPath('success', true);

    $this->assertDatabaseCount('orders', 0);
    Mail::assertNothingSent();
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test tests/Feature/OrderApiTest.php`
Expected: FAIL — the `orders` columns and `/api/orders` route do not exist.

- [ ] **Step 3: Create the migration and models**

Migration `2026_11_14_000001_add_checkout_fields_to_orders_table.php`:

```php
Schema::table('orders', function (Blueprint $table) {
    $table->string('reference')->nullable()->unique()->after('id');
    $table->string('customer_name')->nullable()->after('customer_id');
    $table->string('customer_email')->nullable()->after('customer_name');
    $table->string('customer_phone')->nullable()->after('customer_email');
    $table->string('company')->nullable()->after('customer_phone');
});
```

`down()` drops those columns in reverse order.

Create `app/Models/OrderItem.php` with `$fillable = ['order_id', 'product_id', 'quantity', 'unit_price', 'subtotal']`, `order()` (`belongsTo(Order::class)`), and `product()` (`belongsTo(Product::class)`).

Update `app/Models/Order.php` `$fillable` to add `reference`, `customer_name`, `customer_email`, `customer_phone`, `company`.

Create `config/shop.php`:

```php
<?php

return [
    'notification_email' => env('SHOP_NOTIFICATION_EMAIL', 'info@meksis.co.ke'),
];
```

Add `SHOP_NOTIFICATION_EMAIL=info@meksis.co.ke` to `.env.example`.

- [ ] **Step 4: Implement the order API controller**

Create `app/Http/Controllers/Api/OrderController.php`:

```php
public function store(Request $request): JsonResponse
{
    if ($request->filled('website')) {
        return response()->json([
            'success' => true,
            'reference' => 'MEK-00000000',
            'email' => $request->input('email'),
        ], 201);
    }

    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['required', 'string', 'max:30'],
        'company' => ['nullable', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:1000'],
        'notes' => ['nullable', 'string', 'max:2000'],
        'items' => ['required', 'array', 'min:1'],
        'items.*.id' => ['required', 'integer', 'distinct'],
        'items.*.quantity' => ['required', 'integer', 'min:1', 'max:99'],
    ]);

    // load products, reject missing/unorderable ones with ValidationException::withMessages(['items' => [...]]),
    // compute unit_price/subtotal/total from selling_price only,
    // create order + items + conditional stock decrement inside DB::transaction,
    // then send both mails in separate try/catch blocks and return 201.
}
```

Use `Str::upper(Str::random(8))` prefixed with `MEK-`, retrying while `Order::where('reference', $reference)->exists()`.

Order fields: `reference`, `customer_name`, `customer_email`, `customer_phone`, `company`, `total_amount`, `status = 'pending'`, `payment_status = 'pending'`, `shipping_address = $data['address']`, `notes = $data['notes'] ?? null`.

Stock: inside the transaction, re-read each product with `lockForUpdate()` (ignored on SQLite), treat non-numeric `product_store` as 0, and call `decrement('product_store', $quantity)` only when the numeric stock is at least the quantity.

Mail: `$order->load('items.product');` then `Mail::to($order->customer_email)->send(new OrderConfirmation($order));` and `Mail::to(config('shop.notification_email'))->send(new NewOrderNotification($order));`, each wrapped in `try { } catch (\Throwable $e) { Log::error(...); }`.

Register the route in `routes/api.php`:

```php
Route::post('/orders', [\App\Http\Controllers\Api\OrderController::class, 'store'])
    ->middleware('throttle:10,1');
```

- [ ] **Step 5: Create the two mailables and markdown views**

`OrderConfirmation` and `NewOrderNotification` each hold `public Order $order`, take it in the constructor, and build a markdown mail. Subjects: `Your Meksis order {reference}` and `New Meksis order {reference}`. The notification sets `->replyTo($this->order->customer_email)`.

`resources/views/emails/orderConfirmation.blade.php` uses `@component('mail::message')` and shows: reference, item table (name, quantity, unit price, subtotal), total, delivery address, notes, and a line saying the team will confirm availability and payment arrangements.

`resources/views/emails/orderNotification.blade.php` shows the same order details plus the customer name, email, phone, company, and a `mailto:` button to reply.

Use `{{ $item->product->product_name }}` with a null-safe fallback (`{{ $item->product->product_name ?? 'Product' }}`).

- [ ] **Step 6: Run the tests to verify they pass**

Run: `php artisan test tests/Feature/OrderApiTest.php`
Expected: PASS (7 tests).

- [ ] **Step 7: Commit**

```bash
git add database/migrations/2026_11_14_000001_add_checkout_fields_to_orders_table.php app/Models/OrderItem.php app/Models/Order.php config/shop.php app/Mail/OrderConfirmation.php app/Mail/NewOrderNotification.php resources/views/emails/orderConfirmation.blade.php resources/views/emails/orderNotification.blade.php app/Http/Controllers/Api/OrderController.php routes/api.php .env.example tests/Feature/OrderApiTest.php
git commit -m "feat: persist orders and email checkout confirmations"
```

---

### Task 4: Checkout page and order confirmation page

**Files:**
- Modify: `app/Http/Controllers/CatalogController.php`
- Create: `resources/views/client/shop/checkout.blade.php`
- Create: `resources/js/components/shop/CheckoutPage.vue`
- Create: `app/Http/Controllers/OrderController.php`
- Create: `resources/views/client/shop/order_confirmation.blade.php`
- Modify: `routes/web.php`
- Modify: `resources/js/app.js`
- Test: `tests/Feature/CheckoutPageTest.php`

**Interfaces:**
- Consumes: `POST /api/orders` (`201 { reference, email }`, `422 { message, errors }`), `useCartStore`.
- Produces:
  - `CatalogController@checkout(): \Illuminate\View\View` — view `client.shop.checkout`.
  - `OrderController@show(string $reference): \Illuminate\View\View` — view `client.shop.order_confirmation`, variable `$order` (with `items.product`).
  - Route `GET /order/{reference}` name `order.show`.
  - `CheckoutPage.vue` — mounts `checkout-page`; redirects to `/cart` when empty; clears the cart and navigates to `/order/{reference}` on success.

- [ ] **Step 1: Write the failing page tests**

Create `tests/Feature/CheckoutPageTest.php` with `RefreshDatabase` and a helper that creates an order directly:

```php
public function test_checkout_page_renders_the_checkout_component(): void
{
    $this->get('/checkout')->assertOk()->assertSee('checkout-page', false);
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
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test tests/Feature/CheckoutPageTest.php`
Expected: FAIL — `/checkout` errors because `checkout` is missing; `/order/...` has no route.

- [ ] **Step 3: Add the controller actions and routes**

In `CatalogController`, add:

```php
public function checkout(): View
{
    return view('client.shop.checkout');
}
```

Create `app/Http/Controllers/OrderController.php`:

```php
public function show(string $reference): View
{
    $order = Order::with('items.product')
        ->where('reference', $reference)
        ->firstOrFail();

    return view('client.shop.order_confirmation', compact('order'));
}
```

In `routes/web.php`, add `use App\Http\Controllers\OrderController;` and, near the catalogue routes:

```php
Route::get('/order/{reference}', [OrderController::class, 'show'])->name('order.show');
```

- [ ] **Step 4: Create the Blade pages**

`resources/views/client/shop/checkout.blade.php`: breadcrumbs, `rs-shop-part` section, `<checkout-page></checkout-page>`.

`resources/views/client/shop/order_confirmation.blade.php`: server-rendered; shows a success heading, the reference, the customer name/email, an item table (`$order->items`), the total, delivery address, and a link back to `/store`. Wording: "Order received. We'll confirm availability and payment with you by email."

- [ ] **Step 5: Build `CheckoutPage.vue`**

Create `resources/js/components/shop/CheckoutPage.vue` (Options API, `setup()`):

- On setup, if `cartStore.cartItems.length === 0`, `window.location.href = '/cart'`.
- Form fields bound to a reactive object: `name`, `email`, `phone`, `company`, `address`, `notes` (plus a hidden `website` value `''`).
- Summary list and `Ksh {{ cartTotal }}`.
- Submit handler:
  - `isSubmitting` guard disables the button and prevents double submits.
  - `axios.post('/api/orders', { ...form, items: cartItems.map(({ id, quantity }) => ({ id, quantity })), website: '' })`.
  - On success: `cartStore.clearCart(); window.location.href = '/order/' + response.data.reference;`
  - On 422: show `error.response.data.message` and list `error.response.data.errors.items` when present, with a link back to `/cart`.
  - On other errors: show a generic message.
- Scoped styles reuse the contact form look: `.form-label`, `.form-input`, `.form-textarea`, yellow submit button, square corners.

Register in `resources/js/app.js`:

```js
import CheckoutPage from './components/shop/CheckoutPage.vue';
app.component('checkout-page', CheckoutPage);
```

- [ ] **Step 6: Run the tests to verify they pass**

Run: `php artisan test tests/Feature/CheckoutPageTest.php`
Expected: PASS (3 tests).

- [ ] **Step 7: Commit**

```bash
git add app/Http/Controllers/CatalogController.php app/Http/Controllers/OrderController.php resources/views/client/shop/checkout.blade.php resources/views/client/shop/order_confirmation.blade.php resources/js/components/shop/CheckoutPage.vue routes/web.php resources/js/app.js tests/Feature/CheckoutPageTest.php
git commit -m "feat: add checkout and order confirmation pages"
```

---

### Task 5: Admin orders and product-delete guard

**Files:**
- Create: `app/Http/Controllers/BackOffice/OrderController.php`
- Create: `resources/views/admin/backOffice/order/index.blade.php`
- Create: `resources/views/admin/backOffice/order/show.blade.php`
- Modify: `routes/web.php`
- Modify: `resources/views/admin/partials/left_sidebar.blade.php`
- Modify: `app/Http/Controllers/BackOffice/ProductController.php`
- Test: `tests/Feature/BackOffice/OrderAdminTest.php`
- Test: `tests/Feature/BackOffice/ProductDeleteGuardTest.php`

**Interfaces:**
- Consumes: `Order`, `OrderItem`, `Product`.
- Produces:
  - `BackOffice\OrderController@index(): \Illuminate\View\View` — paginated orders, view `admin.backOffice.order.index`.
  - `BackOffice\OrderController@show(Order $order): \Illuminate\View\View` — view `admin.backOffice.order.show`.
  - `BackOffice\OrderController@updateStatus(Request $request, Order $order): \Illuminate\Http\RedirectResponse`.
  - Routes `orders.index`, `orders.show`, `orders.status` under `auth` + `verified`.
  - `ProductController@DeleteProduct` refuses products referenced by `order_items`.

- [ ] **Step 1: Write the failing admin tests**

Create `tests/Feature/BackOffice/OrderAdminTest.php`:

```php
public function test_guests_are_redirected_from_order_admin_routes(): void
{
    $this->get(route('orders.index'))->assertRedirect(route('login'));
    $this->get(route('orders.show', 1))->assertRedirect(route('login'));
    $this->post(route('orders.status', 1), [])->assertRedirect(route('login'));
}

public function test_an_admin_sees_the_order_list_and_detail(): void
{
    $user = User::factory()->create();
    $order = Order::create([... reference MEK-TEST1234, customer_name Jane, total 3000 ...]);

    $this->actingAs($user)->get(route('orders.index'))
        ->assertOk()->assertSee('MEK-TEST1234')->assertSee('Jane');

    $this->actingAs($user)->get(route('orders.show', $order))
        ->assertOk()->assertSee('MEK-TEST1234');
}

public function test_an_admin_can_update_order_status(): void
{
    $user = User::factory()->create();
    $order = Order::create([...]);

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
    $order = Order::create([...]);

    $this->actingAs($user)->post(route('orders.status', $order), [
        'status' => 'shipped',
        'payment_status' => 'pending',
    ])->assertSessionHasErrors('status');
}
```

Create `tests/Feature/BackOffice/ProductDeleteGuardTest.php`:

```php
public function test_a_product_used_in_an_order_cannot_be_deleted(): void
{
    $user = User::factory()->create();
    $product = $this->product();
    $order = Order::create([...]);
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
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test tests/Feature/BackOffice/OrderAdminTest.php tests/Feature/BackOffice/ProductDeleteGuardTest.php`
Expected: FAIL — routes/controller missing; deleting a used product currently succeeds.

- [ ] **Step 3: Implement the admin order controller and routes**

Create `app/Http/Controllers/BackOffice/OrderController.php`:

```php
public function index(): View
{
    $orders = Order::latest()->paginate(20);
    return view('admin.backOffice.order.index', compact('orders'));
}

public function show(Order $order): View
{
    $order->load('items.product');
    return view('admin.backOffice.order.show', compact('order'));
}

public function updateStatus(Request $request, Order $order): RedirectResponse
{
    $data = $request->validate([
        'status' => ['required', 'in:pending,confirmed,paid,delivered,cancelled'],
        'payment_status' => ['required', 'in:pending,paid'],
    ]);

    $order->update($data);

    return redirect()->back()->with([
        'message' => 'Order updated successfully',
        'alert-type' => 'success',
    ]);
}
```

Add to `routes/web.php`, inside a `Route::middleware(['auth', 'verified'])->group`:

```php
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
```

- [ ] **Step 4: Create the admin views and sidebar item**

`index.blade.php` extends `admin.admin_master`: a card with a table of reference, date, customer, email, phone, total, status, payment status, and a "View" button to `route('orders.show', $order)`. Include an empty state ("No orders yet").

`show.blade.php`: customer/contact block, delivery address, notes, item table (product, quantity, unit price, subtotal), total, and a status form posting to `route('orders.status', $order)` with two selects (`status`, `payment_status`) and a submit button.

In `left_sidebar.blade.php`, add an **ORDERS** link under the Apps group, before Email:

```blade
<li>
    <a href="{{ route('orders.index') }}">
        <i class="mdi mdi-cart-outline"></i>
        <span> ORDERS </span>
    </a>
</li>
```

- [ ] **Step 5: Guard product deletion**

In `ProductController@DeleteProduct($id)`, before deleting:

```php
$product = Product::findOrFail($id);

if (\App\Models\OrderItem::where('product_id', $product->id)->exists()) {
    return redirect()->back()->with([
        'message' => 'This product appears in an order and cannot be deleted. Set its stock to 0 instead.',
        'alert-type' => 'warning',
    ]);
}

$product->delete();
```

Keep the existing success notification below.

- [ ] **Step 6: Run the tests to verify they pass**

Run: `php artisan test tests/Feature/BackOffice/OrderAdminTest.php tests/Feature/BackOffice/ProductDeleteGuardTest.php`
Expected: PASS (6 tests).

- [ ] **Step 7: Commit**

```bash
git add app/Http/Controllers/BackOffice/OrderController.php resources/views/admin/backOffice/order/index.blade.php resources/views/admin/backOffice/order/show.blade.php routes/web.php resources/views/admin/partials/left_sidebar.blade.php app/Http/Controllers/BackOffice/ProductController.php tests/Feature/BackOffice/OrderAdminTest.php tests/Feature/BackOffice/ProductDeleteGuardTest.php
git commit -m "feat: add admin order management and protect ordered products"
```

---

### Task 6: Build assets, run the full suite, and verify

**Files:**
- Modify: `public/build/*` (generated)
- Test: entire suite

**Interfaces:**
- Consumes: all previous tasks.
- Produces: a deployable build and a verified feature.

- [ ] **Step 1: Build the front-end assets**

Run: `npm.cmd run build`
Expected: Vite reports a successful build. If PowerShell reports exit code 1, confirm success from the output and the manifest.

- [ ] **Step 2: Verify the manifest includes the new components**

Open `public/build/manifest.json` (or search the built JS) and confirm the bundle references `product-card`, `cart-page`, `checkout-page`, and `cart-link`.

- [ ] **Step 3: Run the targeted shop/order tests**

Run: `php artisan test tests/Feature/ShopCatalogueTest.php tests/Feature/OrderApiTest.php tests/Feature/CheckoutPageTest.php tests/Feature/BackOffice/OrderAdminTest.php tests/Feature/BackOffice/ProductDeleteGuardTest.php`
Expected: PASS.

- [ ] **Step 4: Run the full suite**

Run: `php artisan test`
Expected: all new tests pass. The only failures should be the five known legacy auth failures (GET `/login` 405, three password-reset tests, registration `username`).

- [ ] **Step 5: Commit the build and finish**

```bash
git add public/build
git commit -m "chore: build shop and checkout assets"
```

- [ ] **Step 6: Record the deploy steps**

Deploy: `php artisan migrate --force`, `php artisan optimize:clear`, confirm `public/upload/products` is writable, and confirm `SHOP_NOTIFICATION_EMAIL=info@meksis.co.ke` (or a Meksis mailbox for the sender) on the server. OPcache may need a restart. Send one live test order and confirm both emails arrive.

---

## Self-Review

- **Spec coverage:** shop index and category pages (Task 1), cart page and header (Task 2), order persistence, pricing, stock, mail, honeypot, rate limit (Task 3), checkout and confirmation pages (Task 4), admin orders and product-delete guard (Task 5), build/deploy (Task 6). Non-goals are excluded.
- **Type consistency:** `isOrderable()`, `image_url`, `is_orderable`, `$order`, `$order->items`, `config('shop.notification_email')`, `orders.index/show/status` are used consistently across tasks.
- **Review Focus:** each of the five failure modes has a named test in its owning task.
- **Proportion:** the plan carries signatures, exact values, and assertions; bodies are left to the implementer except where the algorithm is not obvious.
