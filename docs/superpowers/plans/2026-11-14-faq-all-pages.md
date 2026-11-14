# FAQ Section on All Content Pages Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Show the existing FAQ block on every public content page, including the blog list and blog detail pages.

**Architecture:** The FAQ block is already a globally registered Vue component (`faqs-section`) and every public page renders inside the layout's `#app` element. Add one `<faqs-section></faqs-section>` line to each listed Blade view instead of editing the Vue page components. No API, admin, or component changes.

**Tech Stack:** Laravel 10 Blade, Vue 3, PHPUnit (SQLite `:memory:`).

**Spec:** `docs/superpowers/specs/2026-11-13-faqs-design.md` (Addendum, 2026-11-14)

## Global Constraints

- Do not change `FaqsSection.vue`, `FaqsPage.vue`, the FAQ API, the FAQ admin, or the FAQ data.
- Do not add the block to cart, checkout, payment, search, auth, or admin pages.
- Do not add a second block to the landing, About, Contact, or `/faqs` pages; they already have one.
- One embed per page.
- No new npm or Composer dependencies.
- Tests use the SQLite `:memory:` setup in `phpunit.xml`.
- Five legacy auth tests fail for unrelated reasons (GET `/login` is 405, three password-reset tests, registration omits `username`). Do not fix them in this change.
- Do not commit `public/build`, `storage/logs/laravel.log`, or `bootstrap/cache/` changes.

## Review Focus

- The blog detail embed must render on the page after the article and comments, not inside the article layout. Pinned by the blog detail feature test.
- The blog list embed must render in the loading, populated, and empty states. The tag is static in the Blade view, so all states include it; pinned by the blog list feature test.
- Every listed view must contain the embed. Pinned by the static view check.
- Pages that already have the block must not gain a second one. The plan touches only the eleven listed views; the existing pages are not in the list.
- The block must stay hidden when there are no active FAQs. This is the component's existing `v-if="faqs.length"` behavior and is not changed.

---

### Task 1: Embed the FAQ section and guard it with tests

**Files:**
- Create: `tests/Feature/FaqPlacementTest.php`
- Modify: `resources/views/client/services.blade.php`
- Modify: `resources/views/client/services/service_detail.blade.php`
- Modify: `resources/views/client/blog/blog_list.blade.php`
- Modify: `resources/views/client/blog/blog_details.blade.php`
- Modify: `resources/views/client/ourwork/portfolio.blade.php`
- Modify: `resources/views/client/ourwork/portfolio_details.blade.php`
- Modify: `resources/views/client/pricing/pricing_list.blade.php`
- Modify: `resources/views/client/pricing/pricing_details.blade.php`
- Modify: `resources/views/client/shop/shop_categories.blade.php`
- Modify: `resources/views/client/shop/shop_product.blade.php`
- Modify: `resources/views/client/shop/category_product_list.blade.php`

**Interfaces:**
- Consumes: the globally registered `faqs-section` component in `resources/js/app.js` and the layout's `#app` wrapper in `resources/views/client/layout/app.blade.php`.
- Produces: a `<faqs-section></faqs-section>` element in the rendered HTML of each listed route.

- [ ] **Step 1: Write the failing tests**

Create `tests/Feature/FaqPlacementTest.php`:

```php
<?php

namespace Tests\Feature;

use App\Models\BackOffice\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqPlacementTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_list_page_embeds_the_faq_section(): void
    {
        $this->get(route('blogs.index'))
            ->assertOk()
            ->assertSee('<faqs-section', false);
    }

    public function test_blog_detail_page_embeds_the_faq_section(): void
    {
        $blog = Blog::create([
            'blog_category_id' => 1,
            'author' => 'Meksis',
            'name' => 'Test article',
            'slug' => 'test-article',
            'image' => 'images/blog/default.jpg',
            'description' => '<p>Body</p>',
        ]);

        $this->get(route('show.blog', $blog->slug))
            ->assertOk()
            ->assertSee('<faqs-section', false);
    }

    public function test_every_listed_content_view_embeds_the_faq_section(): void
    {
        $views = [
            'resources/views/client/services.blade.php',
            'resources/views/client/services/service_detail.blade.php',
            'resources/views/client/blog/blog_list.blade.php',
            'resources/views/client/blog/blog_details.blade.php',
            'resources/views/client/ourwork/portfolio.blade.php',
            'resources/views/client/ourwork/portfolio_details.blade.php',
            'resources/views/client/pricing/pricing_list.blade.php',
            'resources/views/client/pricing/pricing_details.blade.php',
            'resources/views/client/shop/shop_categories.blade.php',
            'resources/views/client/shop/shop_product.blade.php',
            'resources/views/client/shop/category_product_list.blade.php',
        ];

        foreach ($views as $view) {
            $this->assertStringContainsString(
                '<faqs-section',
                file_get_contents(base_path($view)),
                "{$view} does not embed the FAQ section."
            );
        }
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test --filter=FaqPlacementTest`

Expected: all three fail because none of the listed views contains `<faqs-section`.

- [ ] **Step 3: Add the embed to all eleven views**

In each file below, insert this line on its own, immediately before the final `@endsection`:

```blade
<faqs-section></faqs-section>
```

Files:
- `resources/views/client/services.blade.php`
- `resources/views/client/services/service_detail.blade.php`
- `resources/views/client/blog/blog_list.blade.php`
- `resources/views/client/blog/blog_details.blade.php`
- `resources/views/client/ourwork/portfolio.blade.php`
- `resources/views/client/ourwork/portfolio_details.blade.php`
- `resources/views/client/pricing/pricing_list.blade.php`
- `resources/views/client/pricing/pricing_details.blade.php`
- `resources/views/client/shop/shop_categories.blade.php`
- `resources/views/client/shop/shop_product.blade.php`
- `resources/views/client/shop/category_product_list.blade.php`

Do not touch `landing.blade.php`, `about.blade.php`, `contact.blade.php`, or `faqs.blade.php`.

- [ ] **Step 4: Run the tests to verify they pass**

Run: `php artisan test --filter=FaqPlacementTest`

Expected: 3 passed.

- [ ] **Step 5: Run the full suite**

Run: `php artisan test`

Expected: the new tests pass; the only failures are the five known legacy auth tests.

- [ ] **Step 6: Commit**

```bash
git add tests/Feature/FaqPlacementTest.php resources/views/client docs/superpowers/specs/2026-11-13-faqs-design.md
git commit -m "feat: show faqs on all content pages"
```

## Manual verification

- Visit `/blogs` and a blog detail page; the FAQ block appears above the footer.
- Visit `/products`, a product detail page, `/our-works`, a portfolio category, `/pricings`, a pricing detail, `/store`, a shop product, and a category listing; each shows the block.
- Visit `/` and confirm the FAQ block still appears once, and `/faqs` still shows the full list without a duplicated header.
- No `npm run build` is needed because no JavaScript changed.
