# FAQs Component, FAQ Page & Admin Management — Design

Date: 2026-11-13
Project: Meksis (Laravel 10 + Vue 3 + Vite)

## Intent

Give visitors answers to common questions on the pages where they are most useful — the landing page, Contact, and About Us — and give them one place to read every FAQ. All content is managed from the existing admin back office, with no code changes needed to update questions or answers.

## Goals

- A reusable FAQ block (section title + accordion) shown on the landing page, Contact page, and About Us page.
- The block shows at most 6 FAQs on those pages.
- A dedicated `/faqs` page listing every active FAQ.
- Admin CRUD for FAQs: add, edit, delete, reorder, activate/deactivate.
- The block's section title and subtitle are editable from the admin.
- Styling matches the existing design language: `--royal-yellow` / `--charcoal`, square corners, uppercase Arial Narrow headings, yellow rule accents.

## Non-goals

- Per-page FAQ sets. All pages share one ordered pool (confirmed with the owner).
- Categories, tags, search, or filtering on the FAQ page.
- Visitor-submitted questions or voting.
- Rich-text/HTML answers beyond line breaks (answers are plain text, rendered with line breaks preserved).
- Localisation / multi-language.

## Anti-goals

- Duplicating accordion markup in three pages.
- Hard-coding FAQ content in Vue components.
- Breaking the existing Vue mount structure or the Blade admin layout.

## Current state (what this touches)

- Landing, Contact, and About pages are Vue 3 components (`resources/js/pages/Welcome.vue`, `Contact.vue`, `AboutUs.vue`) mounted through `resources/views/client/layout/app.blade.php`.
- Frontend data comes from `/api/*` endpoints and is fetched with `fetch`/`axios` (see `BlogSection.vue` and `Header.vue`).
- Admin is Blade CRUD under `resources/views/admin/backOffice/...`, with navigation in `resources/views/admin/partials/left_sidebar.blade.php`.
- `routes/web.php` already declares `GET /faqs` → `CatalogController::faq()`, but `CatalogController` has no `faq()` method. The route is currently broken and will be replaced.
- Shared design tokens live in `resources/css/app.css`:
  - `--royal-yellow: rgb(250, 218, 94)`
  - `--charcoal: rgb(26, 26, 26)`
  - `--slate-steel: rgb(70, 85, 95)`
  - `--white: #ffffff`
  - Global `border-radius: 0`.

## Approaches considered

### A. Public API + one reusable Vue component (chosen)

Add `GET /api/faqs` returning the section title, subtitle, and ordered active FAQs. `FaqsSection.vue` fetches and renders the accordion with a `limit` prop (default 6). `FaqsPage.vue` renders all FAQs at `/faqs`. Admin stays in Blade.

- Pros: matches the existing blog/service data pattern; one accordion implementation; single source of truth; easy to reuse the block elsewhere.
- Cons: client-rendered content (same as the rest of the site).

### B. Server-rendered Blade partial everywhere

- Cons: the three target pages are Vue components, so data would still have to be passed into Vue or the partial would render outside the mount point. Fights the current architecture.

### C. Hybrid — Vue sections, Blade-rendered FAQ page

- Pros: `/faqs` content is crawlable without JavaScript.
- Cons: two accordion implementations and two data paths; inconsistent with the rest of the site. Could be added later without changing the data model if SEO becomes a requirement.

The owner chose **A**.

## Data model

### `faqs`

| Column       | Type              | Notes                                      |
|--------------|-------------------|--------------------------------------------|
| `id`         | bigIncrements     |                                            |
| `question`   | string(255)       | required                                   |
| `answer`     | text              | required, plain text, newlines preserved   |
| `sort_order` | unsignedInteger   | default 0, ascending                       |
| `is_active`  | boolean           | default true                               |
| timestamps   |                   |                                            |

Ordering: `sort_order ASC`, then `id ASC`.

### `faq_settings`

Single-row settings table (`id = 1`).

| Column     | Type          | Notes                                             |
|------------|---------------|---------------------------------------------------|
| `id`       | bigIncrements | seeded with row 1                                 |
| `title`    | string(255)   | default "FREQUENTLY ASKED QUESTIONS"              |
| `subtitle` | string(255)   | default "Answers to the questions we hear most"   |
| timestamps |               |                                                   |

The admin settings screen edits this row. Use `firstOrCreate(['id' => 1], [...defaults])` rather than `findOrFail(1)` everywhere the row is read (admin screen and public API) so a missing row cannot 500 the page or make the public section disappear on a database where the seeder never ran.

`sort_order` behaviour: the add form pre-fills it with `max(sort_order) + 1` so a new FAQ lands at the end; if left blank the controller assigns `max(sort_order) + 1` server-side. "Reorder" in the goals means editing this numeric order value — no drag-and-drop or up/down endpoint in this scope.

## Backend

### Model

`app/Models/BackOffice/Faq.php` — `$guarded = []`, `$casts = ['is_active' => 'boolean']`, scope `active()` and `ordered()`.

`app/Models/BackOffice/FaqSetting.php` — `$guarded = []`.

### Controller

`app/Http/Controllers/BackOffice/FaqController.php`:

- `FaqPage()` — public `client.faqs` view.
- `EditSettings()` / `UpdateSettings(Request)` — edit/update `faq_settings` row 1.
- `AddFaq()` — add form.
- `StoreFaq(Request)` — validate `question` (required, string, max:255), `answer` (required, string), `sort_order` (nullable integer, min:0), `is_active` (boolean); create; redirect to index with a `message`/`alert-type` session flash.
- `IndexOfFaqs()` — list ordered by `sort_order`, `id`.
- `EditFaq($id)` / `UpdateFaq(Request)` — same validation; update by `id`.
- `DeleteFaq($id)` — delete; redirect back with flash.

Follow the flash conventions used by the existing admin controllers/views (`session('message')` + `session('alert-type')`).

### Routes (`routes/web.php`)

Replace the broken `/faqs` route with:

```php
Route::controller(FaqController::class)->group(function () {
    // frontend
    Route::get('faqs', 'FaqPage')->name('faqs.index');

    // admin
    Route::get('faq/settings', 'EditSettings')->name('faq.settings');
    Route::post('faq/settings', 'UpdateSettings')->name('faq.settings.update');
    Route::get('faq/add', 'AddFaq')->name('faq.add');
    Route::post('faq/store', 'StoreFaq')->name('faq.store');
    Route::get('faq/index', 'IndexOfFaqs')->name('faq.index');
    Route::get('faq/edit/{id}', 'EditFaq')->name('faq.edit');
    Route::post('faq/update', 'UpdateFaq')->name('faq.update');
    Route::get('faq/delete/{id}', 'DeleteFaq')->name('faq.delete');
});
```

Admin routes get `->middleware(['auth', 'verified'])`, consistent with the dashboard/product routes. The public `faqs` route stays open.

### Public API (`routes/api.php`)

`GET /api/faqs` with optional `?limit=` (integer, 1–50):

```json
{
  "title": "FREQUENTLY ASKED QUESTIONS",
  "subtitle": "Answers to the questions we hear most",
  "faqs": [
    { "id": 1, "question": "...", "answer": "..." }
  ]
}
```

Only `is_active` FAQs are returned, ordered by `sort_order`, `id`. If `limit` is absent, all active FAQs are returned. Implement as a closure or a small `FaqController@apiIndex`; keep it consistent with the existing simple API closures.

## Admin UI

New Blade views under `resources/views/admin/backOffice/faq/`:

- `index_faq.blade.php` — table: #, Question, Order, Status, Actions (edit/delete). Uses the same data-table and toastr/flash pattern as `index_homeslider.blade.php`. Delete confirmation as in existing list views.
- `add_faq.blade.php` — form: Question, Answer (`<textarea>`), Sort order, Active checkbox. Submit to `faq.store`.
- `edit_faq.blade.php` — same fields, prefilled, submit to `faq.update`.
- `edit_faq_settings.blade.php` — Title and Subtitle fields, submit to `faq.settings.update`.

Sidebar (`resources/views/admin/partials/left_sidebar.blade.php`) — add a collapsible "FAQ SECTION" item, matching the existing sections:

- FAQ Settings → `faq.settings`
- Add a FAQ → `faq.add`
- All FAQs → `faq.index`

## Frontend

### `resources/js/components/FaqsSection.vue`

- Props: `limit` (Number, default `6`), `showViewAll` (Boolean, default `true`), `showHeader` (Boolean, default `true`), `injectSchema` (Boolean, default `false`).
- On mount, `GET /api/faqs?limit=<limit>`; store `title`, `subtitle`, `faqs`.
- Renders:
  - Section header (when `showHeader`): title (uppercase, 2.5rem, 900 weight, charcoal) and subtitle (uppercase, bold, grey), centered — matching `BlogSection.vue`.
  - Accordion: each item is a `<button>` header (question + plus/minus indicator) and a collapsible panel. Single-open behaviour; the first item is open initially. Use `aria-expanded`, `aria-controls`, and `role="region"` for accessibility.
  - Item styling: white background, 1px `#e0e0e0` border that turns `--royal-yellow` on hover/open, yellow left rule on the open item, charcoal uppercase question, answer in `#666` with `white-space: pre-line`.
  - "VIEW ALL FAQs" button linking to `/faqs`, styled like `.view-all-link` in `BlogSection.vue` (yellow background, charcoal uppercase text), shown only when `showViewAll` and there are FAQs.
  - Injects `FAQPage` JSON-LD structured data only when `injectSchema` is true (used solely on `/faqs`, to avoid declaring the same FAQ page on four URLs).
- Hides the whole section if the request fails, returns no FAQs, or is still loading (no empty yellow band).
- Responsive: stack cleanly under 768px; reduce title to 1.75rem.

### `resources/js/pages/FaqsPage.vue`

- Breadcrumb hero consistent with `Contact.vue` (`rs-breadcrumbs`, charcoal, yellow bottom border, HOME / FAQS). The hero heading and subtitle come from the API's `title`/`subtitle` so the admin still owns the copy; fall back to "FREQUENTLY ASKED QUESTIONS" if the request fails.
- Fetches all FAQs from `/api/faqs` and renders `<FaqsSection :show-header="false" :show-view-all="false" :inject-schema="true" />` below the hero. The section component remains the single accordion implementation; `showHeader=false` prevents the heading appearing twice.
- Empty state: a short "No FAQs yet" message if none are active.


### Integration

- `resources/js/pages/Welcome.vue` — add `<FaqsSection />` after `<BlogSection />`.
- `resources/js/pages/Contact.vue` — add `<FaqsSection />` after `<ContactSection />` and before the map section (use `<FaqsSection />` inside a wrapper as needed to avoid conflicting layout).
- `resources/js/pages/AboutUs.vue` — add `<FaqsSection />` after the Products section.
- `resources/views/client/faqs.blade.php` — extends `client.layout.app` and renders `<faqs-page>`.
- `resources/js/app.js` — register `faqs-section` and `faqs-page`.

Page head: `resources/views/client/layout/app.blade.php` hardcodes `<title>` and meta tags and does not yield the `title`/`meta_*` sections that existing pages define. Adding those yields would silently replace head copy across the whole site, so this feature does **not** touch the shared head. `FaqsPage.vue` sets `document.title` and the meta description client-side on mount, matching the site's existing client-rendered behaviour.

### Navigation

- Footer bottom menu (`Footer.vue`): add `FAQS` → `/faqs`.
- Header desktop and mobile nav (`Header.vue`): add `FAQS` → `/faqs` after `BLOG`. This is the builder's call, but keeping the FAQ page reachable from the header is preferred; if the nav gets too crowded at the 1200px breakpoint, the footer link alone is acceptable.

## Seeder (starter content)

`database/seeders/FaqSeeder.php` inserts 6 placeholder FAQs using facts already stated on the site (tank types, installation coverage, maintenance, quotes/site visits), plus the `faq_settings` row. Register it in `DatabaseSeeder::run()`. These are starter copy for the owner to review and edit in the admin — not invented commercial claims (no prices, warranties, or lead times). Deployment note: run `php artisan migrate`, `php artisan db:seed --class=FaqSeeder` (or `db:seed`, which now includes it), and `npm run build` on the target deployment so the emitted Vite manifest includes `FaqsSection`/`FaqsPage`; `firstOrCreate` makes the settings safe if seeding is skipped.

## Constraints & conventions

- PHP 8.1 / Laravel 10; keep the existing `$guarded = []` + simple controller style.
- Vue 3 `<script setup>` for new components.
- No new npm dependencies.
- CSS variables and square-corner aesthetic are mandatory.
- Do not convert existing pages to Blade/Inertia.
- The existing `/faqs` route must be replaced, not duplicated.

## What is left to the builder

- Exact accordion transition (height/opacity) and control glyph.
- Whether the FAQ admin routes are grouped under the existing auth middleware or left open like surrounding admin routes. Recommended: auth + verified.
- Whether to add the header nav link in addition to the footer link (see Navigation).
- Seeder wording details, as long as no unverifiable commercial claims are introduced.
- Whether to add an index on `(is_active, sort_order)` — safe to include.

## Addendum (2026-11-14): FAQ section on every public content page

Intent: The shared FAQ block should appear on every public content page, not only the landing, About, and Contact pages. The blog list and blog detail pages were the notable gaps.

Scope:

- Already covered and unchanged: `/` (landing), `/about`, `/contact` (embedded in their Vue pages) and `/faqs` (full list).
- New placements, all added as `<faqs-section></faqs-section>`:
  - `resources/views/client/services.blade.php` - products list (`/products`)
  - `resources/views/client/services/service_detail.blade.php` - product detail (`show/product/{slug}`)
  - `resources/views/client/blog/blog_list.blade.php` - blog list (`/blogs`)
  - `resources/views/client/blog/blog_details.blade.php` - blog detail (`show/blog/{slug}`)
  - `resources/views/client/ourwork/portfolio.blade.php` - our works
  - `resources/views/client/ourwork/portfolio_details.blade.php` - portfolio category
  - `resources/views/client/pricing/pricing_list.blade.php` - pricing list
  - `resources/views/client/pricing/pricing_details.blade.php` - pricing detail
  - `resources/views/client/shop/shop_categories.blade.php` - shop categories (`/store`)
  - `resources/views/client/shop/shop_product.blade.php` - shop product detail
  - `resources/views/client/shop/category_product_list.blade.php` - category product list
- Excluded: cart, checkout, payment success/cancel, search, login/register/password screens, and the admin.

How:

- Every public page renders inside the layout's `#app` element (`resources/views/client/layout/app.blade.php`), and `faqs-section` is globally registered in `resources/js/app.js`. The embed therefore lives in the Blade view and needs no change to the Vue page components.
- Add the tag as the last element of `@section('content')` in each listed view, so it sits above the WhatsApp button and footer.
- The component keeps its default six-item limit, header, and "View all FAQs" link. `/faqs` keeps its full-list behavior with `:show-header="false"` and is not changed.

Non-goals:

- Per-page FAQ sets, categories, or different limits.
- Changes to `FaqsSection.vue`, the FAQ API, the FAQ admin, or `/faqs`.
- FAQ blocks on transactional or auth pages.

Acceptance:

- Each listed page renders the FAQ block above the footer when at least one FAQ is active.
- When no FAQs are active, each page shows no empty FAQ block (the component's existing `v-if="faqs.length"` covers this).
- `/faqs` still renders the full list without a duplicated section header.
- No FAQ data, admin, or API changes.
