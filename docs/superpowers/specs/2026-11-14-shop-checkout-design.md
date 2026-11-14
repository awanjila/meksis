# Front-end Shop, Cart Page, and Email Checkout - Design

Date: 2026-11-14
Project: Meksis (Laravel 10 + Vue 3 + Vite)

## Intent

Turn the existing back-office product catalogue into a real front-end shop, add a full cart page, and let a visitor place an order at checkout. Checkout does not take money online: it records the order, emails a confirmation to the address the visitor enters, and sends a copy to the business at `info@meksis.co.ke`. The owner can then confirm availability, delivery, and payment directly.

## Decisions confirmed with the owner

- **No online payment.** Checkout collects the order; M-Pesa/PayPal are out of scope for this change.
- **The order is emailed to the customer's address** entered at checkout.
- **The business copy goes to `info@meksis.co.ke`** (not `sales@`).
- **A full cart page is required** (`/cart`), not only the existing slide-out drawer.
- Approach chosen: **save the order and email it** (Option A), not email-only (Option B).

## Goals

- `GET /store` shows the shop: all products in a grid, with category filters and a link into each product.
- Product pages get a working "Add to Cart" control. The existing `AddToCart.vue` is reused.
- `GET /cart` shows a full cart page: line items, quantity controls, remove, subtotal, and a checkout button.
- `GET /checkout` shows a checkout form (name, company optional, email, phone, delivery address, notes) and the order summary.
- `POST /api/orders` validates the cart, recalculates every price from the database, saves an `orders` row plus `order_items`, decrements stock where stock is positive, and emails both the customer and `info@meksis.co.ke`.
- `GET /order/{reference}` shows a thank-you / order summary page after checkout.
- The header gets a **SHOP** link and a cart icon with an item count that links to `/cart`. The **PRODUCTS** dropdown lists shop categories instead of services.
- A new admin **Orders** screen lists orders, shows one order in detail, and lets the owner update order/payment status.
- Guest checkout works: no login, no customer account required.
- Only products with a usable price appear in the shop and can be ordered.

## Non-goals

- Online payments of any kind: M-Pesa STK push, PayPal, cards, invoices. The existing PayPal/M-Pesa controllers are not wired to this flow.
- Customer accounts, login, registration, order history for customers, or Google sign-in.
- Coupons, discounts, shipping fees, tax, multi-currency, or currency conversion.
- Real-time stock reservation, backorder handling, or blocking checkout when stock is zero.
- Automatic restocking when an order is cancelled; the owner corrects stock in the product admin.
- Preserving order history through a product deletion; deletion is blocked once a product appears in an order.
- Product search, product reviews, wishlists, or related-product recommendations beyond what already exists.
- Fixing unrelated broken catalogue routes (`/brand/{slug}`, `/search`, `/delivery`, `/terms`, distributor forms, coupon check).
- Abandoned-cart emails, SMS notifications, or queue workers.
- A new admin product/category module; the existing ones stay as they are.

## Anti-goals

- An email-only checkout that loses orders when SMTP fails.
- Trusting prices or totals sent by the browser; every price is read from `products` server-side.
- Sending email before the order transaction commits.
- Replacing the existing cart store, product models, or admin layout.
- Breaking the FAQ, home-content, or existing admin work.
- New npm or Composer dependencies.

## Current state (what this touches)

- `routes/web.php` already declares the front-end shop routes (`/store`, `/category/{slug}`, `/products/{slug}`, `/show/product-1/{slug}`, `/show/cart`, `/checkout`) against `CatalogController`, but only `showByCategory()` and `show()` exist. `Index`, `showProducts`, `showCart`, and `checkout` are missing, so those routes error.
- `app/Http/Controllers/CatalogController.php` has `showByCategory($slug)` and `show($slug)` (product detail). The class is named `Catalogcontroller` (lowercase `c`); PHP treats it case-insensitively, but it should be corrected to `CatalogController` while touching the file.
- `resources/views/client/shop/category_product_list.blade.php` and `shop_product.blade.php` already render product cards with the template's `rs-shop-part` / `product-list` classes. Product links in `category_product_list` point at `route('show.product')`, which maps to `/show/product-1/{slug}`. Related-product links and overley links are placeholders (`shop-single.html`).
- `resources/js/components/shop/AddToCart.vue` adds `{ id, name, price, image, quantity }` to the Pinia cart. It is registered globally but no Blade view uses it.
- `resources/js/components/shop/Cart.vue`, `Checkout.vue`, and `CartToggle.vue` are registered globally and unused by any Blade view. `Checkout.vue` fakes M-Pesa success with a 30-second timeout and posts to `/api/paypal/*` (customer-auth only). Neither it nor the M-Pesa controller can currently persist an order: `Order::create()` writes `payment_method`, `payment_id`, `items`, and `user_id`, none of which exist on `orders` or in `Order::$fillable`.
- `resources/js/store/cart.js` is the Pinia store used by the shop components (localStorage, computed total/count). `resources/js/store/modules/cart.js` is an unused Vuex module.
- `database/migrations/2025_04_08_003336_create_orders_table.php` defines `customer_id`, `total_amount`, `status`, `payment_status`, `shipping_address`, `billing_address`, `notes`. It has no order reference and no guest contact fields.
- `database/migrations/2025_04_08_003338_create_order_items_table.php` defines `order_id`, `product_id` (`cascadeOnDelete`), `quantity`, `unit_price`, `subtotal`. There is no `OrderItem` model. Because the product admin hard-deletes products, a deletion currently removes that product's lines from past orders.
- `database/migrations/2023_04_08_000803_create_products_table.php` defines `product_name`, `slug`, `category_id`, `product_image`, `selling_price` (string), `product_store` (string stock), `product_description`, `product_features`.
- `resources/views/client/layout/app.blade.php` wraps the header, Blade content, and footer in `<div id="app">`; Vue components inside Blade views work today.
- `resources/js/components/layout/Header.vue` fetches `/api/services` for the PRODUCTS dropdown and links to `/show/product/{slug}` (services, not products). There is no shop or cart link.
- `app/Http/Controllers/ContactController.php` sends mail through `Mail::to(...)->send(new ContactMail(...))` inside try/catch, and is the pattern to follow.
- Mail is SMTP from `.env` (`MAIL_FROM_ADDRESS=info@wabestudio.co.ke`, host `business79.web-hosting.com`). `QUEUE_CONNECTION=sync`.
- Admin routes live in `routes/web.php` under `auth` + `verified`; `resources/views/admin/admin_master.blade.php` and `resources/views/admin/partials/left_sidebar.blade.php` are the layout/sidebar.
- Tests use PHPUnit with SQLite `:memory:` (`phpunit.xml`), `RefreshDatabase`, and `MAIL_MAILER=array`.
- Shared design tokens: `--royal-yellow: rgb(250, 218, 94)`, `--charcoal: rgb(26, 26, 26)`, square corners, uppercase Arial Narrow headings, charcoal/yellow buttons.

## Approaches considered

### A. Save the order and email it (chosen)

Checkout writes `orders` + `order_items`, then sends a customer confirmation and a business notification. Adds an admin Orders screen.

- Pros: orders survive mail failures; the owner can see, follow up, and mark paid/delivered; stock can be decremented; reuses the existing order tables and mail pattern.
- Cons: one migration, two mailables, an admin screen, and slightly more code than email-only.

### B. Email only

Checkout composes one email to the customer and one to the business; nothing is stored.

- Pros: least code.
- Cons: an SMTP failure or a misfiled message loses the order; no order list, no status, no stock movement. Rejected by the owner.

### C. Fix the existing drawer and fake payments

Use `Cart.vue`/`Checkout.vue` as-is and finish M-Pesa/PayPal.

- Rejected: the owner does not want online payment, the drawer is not the requested cart page, and the existing payment code is non-functional and needs credentials and callbacks.

## The how

### Routes

Front end (`routes/web.php`):

| Method | Path | Handler | Name |
|---|---|---|---|
| GET | `/store` | `CatalogController@index` | `catalog.index` |
| GET | `/category/{slug}` | `CatalogController@showProducts` | `category.products` |
| GET | `/products/{slug}` | `CatalogController@showByCategory` | `products.byCategory` |
| GET | `/show/product-1/{slug}` | `CatalogController@show` | `show.product` |
| GET | `/cart` | `CatalogController@showCart` | `show.cart` |
| GET | `/checkout` | `CatalogController@checkout` | `show.checkout` |
| GET | `/order/{reference}` | `OrderController@show` | `order.show` |

API (`routes/api.php`):

| Method | Path | Handler | Notes |
|---|---|---|---|
| POST | `/api/orders` | `Api\OrderController@store` | public, `throttle:10,1` |

Admin (`routes/web.php`, inside `auth` + `verified`):

| Method | Path | Handler | Name |
|---|---|---|---|
| GET | `/orders` | `BackOffice\OrderController@index` | `orders.index` |
| GET | `/orders/{order}` | `BackOffice\OrderController@show` | `orders.show` |
| POST | `/orders/{order}/status` | `BackOffice\OrderController@updateStatus` | `orders.status` |

`showProducts($slug)` delegates to `showByCategory($slug)` so `/category/{slug}` and `/products/{slug}` render the same category page. Missing methods that are not part of this change (`searchProducts`, `checkoutInvoice`, `checkDelivery`, etc.) stay untouched.

### Schema

One migration, `add_checkout_fields_to_orders_table`:

- `orders.reference` — string, unique, nullable (existing rows stay null; new rows always get a value).
- `orders.customer_name` — string, nullable.
- `orders.customer_email` — string, nullable.
- `orders.customer_phone` — string, nullable.
- `orders.company` — string, nullable.

`orders.shipping_address`, `orders.notes`, `orders.total_amount`, `orders.status`, and `orders.payment_status` are reused as-is. `order_items` is reused unchanged. No columns are dropped or renamed, so the old PayPal/M-Pesa code is not made worse.

New model `App\Models\OrderItem` with `order_id`, `product_id`, `quantity`, `unit_price`, `subtotal` fillable, and `order()` / `product()` relations.

`Order` gains the new fields in `$fillable` and keeps its existing `items()` relation.

### Order creation (`POST /api/orders`)

Request:

```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "phone": "0712345678",
  "company": "Acme Ltd",
  "address": "Industrial Area, Nairobi",
  "notes": "Please call before delivery",
  "items": [{ "id": 12, "quantity": 2 }],
  "website": ""
}
```

Validation:

- `name` required, string, max 255.
- `email` required, email, max 255.
- `phone` required, string, max 30.
- `company` nullable, string, max 255.
- `address` required, string, max 1000.
- `notes` nullable, string, max 2000.
- `items` required array, min 1; each item has `id` exists in `products` and `quantity` integer 1–99.
- `website` must be empty (honeypot). A non-empty honeypot returns the normal success response without creating anything, so bots do not learn.

Server behaviour:

1. Load the products by id in one query. A product is orderable only when `selling_price` is numeric and greater than zero. If any id is missing or not orderable, return a 422 validation error naming the unavailable product.
2. Compute `unit_price` from `products.selling_price`, `subtotal = unit_price * quantity`, and `total = sum(subtotals)`. Round money to two decimals. Ignore any price sent by the client.
3. Generate `reference` as `MEK-` + 8 uppercase alphanumeric characters, retrying on a unique collision.
4. In one database transaction: create the order (`status = pending`, `payment_status = pending`, `shipping_address = address`, contact fields), create the items, and decrement `products.product_store` by the ordered quantity **only where stock is numeric, greater than zero, and greater than or equal to the ordered quantity**. Stock is not a blocker: this is an order request that the team confirms, and existing catalogue stock may be untidy. Never let stock go below zero.
5. After the transaction commits, send:
   - `OrderConfirmation` to `customer_email`
   - `NewOrderNotification` to `config('shop.notification_email')` (`SHOP_NOTIFICATION_EMAIL`, default `info@meksis.co.ke`)
   Each send is in its own try/catch; a mail failure is logged and does not fail the request.
6. Return `201` with `{ success: true, reference, email }`. Validation failures use Laravel's normal `422` JSON shape.

### Cart

- The existing Pinia `useCartStore` (`resources/js/store/cart.js`) remains the single cart. It persists to `localStorage`.
- Cart line shape stays `{ id, name, price, image, quantity }`, but `image` becomes a full URL. `AddToCart.vue` uses `product.image_url` when provided and falls back to `product.product_image`.
- `AddToCart.vue` gets an optional stock/disabled state only if the product card passes stock; not required for this change.
- `/cart` mounts `CartPage.vue`. It lists items, allows quantity changes and removal, shows the total, and links to `/checkout`. Empty state links back to `/store`.
- `/checkout` mounts `CheckoutPage.vue`. It redirects to `/cart` when the cart is empty, shows the summary, and posts to `/api/orders`. On success it clears the cart and navigates to `/order/{reference}`. If the server returns 422 because a product was removed or became unorderable, the page shows a clear error, names the affected line, and offers a link back to the cart; the customer can remove it and retry.
- The cart total shown on `/cart` and `/checkout` comes from the localStorage snapshot. The server is authoritative: if an admin changed a price between adding and submitting, the order and confirmation use the current database price. No quote/refresh endpoint is added in this change.
- The old `Cart.vue`, `Checkout.vue`, and `CartToggle.vue` drawers are superseded. They are removed from `app.js` and deleted so there is no dead/fake checkout code. `AddToCart.vue` stays.
- The unused Vuex `resources/js/store/modules/cart.js` is left alone (out of scope).

### Pages and components

New Blade views:

- `client/shop/index.blade.php` — breadcrumbs, category filter chips, product grid. Uses the existing `rs-shop-part` / `product-list` markup. Each card is a `product-card` Vue component (or the existing markup plus `add-to-cart`) so the Add to Cart button has the data it needs.
- `client/shop/cart.blade.php` — `<cart-page>`.
- `client/shop/checkout.blade.php` — `<checkout-page>`.
- `client/shop/order_confirmation.blade.php` — server-rendered order summary (reference, items, total, delivery address, "a confirmation was sent to …"). No Vue needed.

New Vue components, registered globally in `app.js`:

- `shop/CartPage.vue`
- `shop/CheckoutPage.vue`
- `shop/ProductCard.vue` (product image, name, price, Add to Cart)
- `shop/CartLink.vue` (header cart icon + count)

Updated:

- `layout/Header.vue` — add SHOP (`/store`) and the cart icon on desktop and mobile; PRODUCTS dropdown now lists categories from `/api/categories` and links to `/category/{slug}`.
- `shop/AddToCart.vue` — absolute image URL, guard quantity.
- `app.js` — replace the old shop registrations with the new ones.

Styling follows the existing template: `rs-shop-part`, `product-list`, `rs-breadcrumbs`, and the contact-form field styles from `ContactSection.vue` (`form-label`, `form-input`, yellow highlight, square corners). Cart and checkout are ordinary page sections, not fixed drawers.

### Mail

Two new mailables:

- `App\Mail\OrderConfirmation` — markdown view `emails.orderConfirmation`. To the customer. Subject includes the reference. Lists items, quantities, unit prices, subtotals, total, delivery address, and notes. Says the team will confirm availability and payment arrangements.
- `App\Mail\NewOrderNotification` — markdown view `emails.orderNotification`. To the business. Same order detail plus the customer's name, email, phone, company, and a `mailto:` reply button.

Both use `config('mail.from.address')` for the sender and set `replyTo` to the customer's email on the business notification. No attachments and no invoices.

### Admin Orders

- `BackOffice\OrderController@index` — paginated list: reference, date, customer, email, phone, total, status, payment status.
- `BackOffice\OrderController@show` — full order with items and contact details.
- `BackOffice\OrderController@updateStatus` — validates `status` in `pending, confirmed, paid, delivered, cancelled` and `payment_status` in `pending, paid`; redirects back with the existing notification flash pattern.
- Views `admin/backOffice/order/index.blade.php` and `show.blade.php` use the existing `admin.admin_master` layout and datatable/card patterns.
- Sidebar gains an **ORDERS** item under a sensible group.
- Status changes are labels only: cancelling an order does **not** automatically restore stock.
- `BackOffice\ProductController@DeleteProduct` refuses to delete a product that appears in any `order_items` row, redirecting back with a warning that the product has orders and should be marked out of stock instead. This protects past orders and their emails from cascade deletion.

### Configuration

New `config/shop.php`:

```php
return [
    'notification_email' => env('SHOP_NOTIFICATION_EMAIL', 'info@meksis.co.ke'),
];
```

`.env.example` gains `SHOP_NOTIFICATION_EMAIL=info@meksis.co.ke`.

## Security and correctness

- Prices and subtotals always come from the database, never the request.
- Products with a null, non-numeric, or zero `selling_price` are excluded from the shop grid and rejected at checkout.
- A null or non-numeric `product_store` is treated as zero for stock purposes.
- Order/item writes are wrapped in a transaction; mail is sent after commit.
- `POST /api/orders` is public but rate-limited (`throttle:10,1`) and honeypotted.
- The API returns only `reference` and `email`; no customer data is exposed.
- The confirmation page looks orders up by `reference`, not id.
- Admin order routes require `auth` + `verified`.
- Existing `.env` SMTP credentials are reused; no secrets are added to the repo.
- Stock decrements use a conditional update so a race cannot take stock below zero.

## Testing

Feature tests (SQLite `:memory:`, `RefreshDatabase`, `Mail::fake()`):

- `/store` returns 200 and lists a created product.
- `/category/{slug}` and `/products/{slug}` render the category's products.
- Product detail page renders the Add to Cart component.
- `/cart` and `/checkout` return 200.
- `POST /api/orders`:
  - creates `orders` + `order_items` with server-side prices, ignoring a forged price;
  - decrements stock only when positive and never below zero;
  - sends `OrderConfirmation` to the customer and `NewOrderNotification` to `info@meksis.co.ke`;
  - returns 201 with the reference;
  - rejects an empty cart, a missing product, and quantity 0/100;
  - rejects a product with a null/zero/non-numeric price;
  - leaves the honeypot case with no order.
- A product used in an order cannot be deleted from the product admin; an unused product still can.
- Changing an order to `cancelled` does not change product stock.
- `/order/{reference}` shows the order; an unknown reference 404s.
- Admin `/orders` redirects guests to login; an authenticated verified user sees the list and can update status.
- Mail failures do not roll back the order (simulate by throwing from a fake mailer or by asserting a saved order with a mail exception).

Manual verification: build the assets, browse `/store` → add to cart → `/cart` → `/checkout` → submit, confirm both emails and the thank-you page, then check the admin order and status update.

## Deployment notes

- Run the new migration with `php artisan migrate --force`.
- Rebuild with `npm.cmd run build` and commit the fresh `public/build` (consistent with the FAQ/home-content release).
- `php artisan optimize:clear` after deploy; OPcache may also need a restart.
- Confirm `public/upload/products` is writable and existing product images resolve.
- Mail deliverability: the current sender is `info@wabestudio.co.ke` through the Wabe Studio SMTP host. Sending on behalf of Meksis is safest with `Reply-To: info@meksis.co.ke`; if a Meksis mailbox exists, prefer configuring `MAIL_FROM_ADDRESS`/credentials for it. This is a deployment choice, not a code change.

## What is left to the builder

- Exact markup of the cart/checkout pages within the template's existing classes.
- Whether the shop grid uses pagination or shows all products (the catalogue is small; showing all is acceptable).
- Wording of the two emails and the confirmation page.
- The admin status update UI (inline select vs buttons).
- Whether to add a `product_card` partial to avoid repeating card markup.
- Test file organisation, following the existing `tests/Feature` pattern.

## My calls (flagged so they can be checked)

- Stock does not block checkout; it is decremented only when it is numeric and at least the ordered quantity. Sales confirms availability.
- Cancelling an order does not automatically restock; the owner can correct stock in the product admin.
- Deleting a product that appears in an order is blocked, so past orders and their emails keep their line items. Unused products can still be deleted.
- The cart uses the price snapshot from localStorage; the server recalculates on submit. A removed or unorderable product returns a clear 422 rather than a silent change.
- Products with a missing, zero, or non-numeric price are hidden from the shop and rejected at checkout.
- The old fixed-position cart/checkout drawers are deleted rather than kept alongside the new pages.
- Order references are `MEK-XXXXXXXX` (8 uppercase alphanumerics).
- The business notification address is `info@meksis.co.ke`, configurable through `SHOP_NOTIFICATION_EMAIL`.
- The PRODUCTS dropdown switches from services to shop categories, since the menu is labelled Products.
- The shop index shows all products, with category filter links; no pagination in this change.
- `Product` gets an `image_url` accessor so the cart stores a full image URL.
