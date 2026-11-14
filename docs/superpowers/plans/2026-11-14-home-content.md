# Editable Landing Hero, Homepage About, and Landing Contact - Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Make the landing hero and homepage About block editable from the existing admin, and add the existing contact / get-a-quote section as the last landing section.

**Architecture:** Two small read-only API endpoints (`GET /api/home-slides`, `GET /api/about`) feed `HeroSection.vue` and `AboutSection.vue`, while the existing Home Slider and About admin screens become the editors. The `abouts` table gains nullable homepage columns with defaults in `config/home_content.php`; the hero reuses `home_sliders`. `Welcome.vue` renders the existing `ContactSection` after `FaqsSection`.

**Tech Stack:** Laravel 10, Vue 3 `<script setup>` (About) and Options API (Hero), Vite, PHPUnit 10 with SQLite `:memory:`.

**Spec:** `docs/superpowers/specs/2026-11-13-home-content-design.md`

## Global Constraints

- No new npm or Composer dependencies.
- Public reads go through `/api/*`; admin writes stay in Blade controllers.
- The two hero buttons (`/contact`, `/products`) and both About CTA buttons stay hardcoded.
- The `/about` page (`AboutUs.vue`) stays hardcoded; only the homepage `AboutSection.vue` is wired.
- Admin slider and about edit routes require `auth` + `verified`. The public `about` and `pricing_and_packages` routes stay outside.
- Hero order is `id ASC`; no `sort_order`, activation toggle, or drag-and-drop.
- Clearing an About field stores `null` and the API returns the config default.
- Keep the existing design tokens (`--royal-yellow`, `--charcoal`, square corners, uppercase Arial Narrow headings).
- Tests use the SQLite `:memory:` setup in `phpunit.xml`.
- Five legacy auth tests fail for unrelated reasons (GET `/login` is 405, three password-reset tests, registration omits `username`). Do not fix them here.
- Do not commit `public/build`, `storage/logs/laravel.log`, or `bootstrap/cache/` changes.
- `Image` is Intervention Image v2 (`Image::make(...)->resize(...)->save(...)`).

## Review Focus

- **Hero API empty or failing:** the landing must still show the four built-in slides and must not crash when there are zero slides. Task 4 guards the render and autoplay; Task 1 pins the empty API response.
- **Cleared About field:** a blank headline/stat/paragraph must fall back to the configured default rather than render empty. Task 1 pins the null fallback.
- **Slide edit without a new image:** saving an existing slide must keep its current `home_slide`. Task 3 pins this regression.
- **Upload directory missing:** `public/upload/home_slide` and `public/upload/about_image` do not exist in this checkout; uploads must create them and write under `public/`. Tasks 2 and 3 handle this; verified manually.
- **TinyMCE unavailable:** the About form must still submit when the placeholder-key TinyMCE script fails to load. Task 2 guards the init and the description read; verified manually.
- **Broken hero fallback image:** `steel-fabrication.jpg` does not exist in `public/images/hero/`. Task 4's static test pins every fallback image path to an existing file.
- **Contact placement:** the landing contact section must be the last section, after the FAQs. Task 4's static test pins the order.

---

### Task 1: Content API, migration, and defaults

**Files:**
- Create: `database/migrations/2026_11_14_000000_add_homepage_fields_to_abouts_table.php`
- Create: `config/home_content.php`
- Create: `app/Http/Controllers/Api/HomeContentController.php`
- Modify: `routes/api.php`
- Test: `tests/Feature/HomeContentApiTest.php`

**Interfaces:**
- Produces: `GET /api/home-slides` returning `{ "slides": [{ id, title, description, image }] }`, ordered by `id`, with absolute image URLs or `null`.
- Produces: `GET /api/about` returning `{ section_label, headline, highlight_word, paragraph_one, paragraph_two, image, stats: [{ number, label }, { number, label }] }`.
- Produces: `config('home_content.about')` with keys `title`, `vision`, `mission`, `description`, `section_label`, `headline`, `highlight_word`, `paragraph_one`, `paragraph_two`, `stat_one_number`, `stat_one_label`, `stat_two_number`, `stat_two_label`, `image`. Tasks 2 and 4 consume it.
- Produces: `abouts` columns for the nine homepage fields in the spec's data table.

- [ ] **Step 1: Write the failing API tests**

Create `tests/Feature/HomeContentApiTest.php`:

```php
<?php

namespace Tests\Feature;

use App\Models\BackOffice\About;
use App\Models\BackOffice\HomeSlider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeContentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_slides_are_ordered_by_id_and_return_absolute_image_urls(): void
    {
        HomeSlider::create([
            'title' => 'Second',
            'short_description' => 'Second description',
            'home_slide' => 'upload/home_slide/b.jpg',
        ]);
        HomeSlider::create([
            'title' => 'First',
            'short_description' => 'First description',
            'home_slide' => 'upload/home_slide/a.jpg',
        ]);

        $this->getJson('/api/home-slides')
            ->assertOk()
            ->assertJsonCount(2, 'slides')
            ->assertJsonPath('slides.0.id', 1)
            ->assertJsonPath('slides.0.title', 'Second')
            ->assertJsonPath('slides.0.description', 'Second description')
            ->assertJsonPath('slides.0.image', asset('upload/home_slide/b.jpg'))
            ->assertJsonPath('slides.1.id', 2)
            ->assertJsonPath('slides.1.image', asset('upload/home_slide/a.jpg'));
    }

    public function test_slides_return_an_empty_array_when_the_table_is_empty(): void
    {
        $this->getJson('/api/home-slides')
            ->assertOk()
            ->assertJsonCount(0, 'slides');
    }

    public function test_slides_return_a_null_image_when_the_slide_has_none(): void
    {
        HomeSlider::create(['title' => 'No image', 'short_description' => 'Text']);

        $this->getJson('/api/home-slides')
            ->assertOk()
            ->assertJsonPath('slides.0.image', null);
    }

    public function test_about_returns_the_configured_defaults_when_no_row_exists(): void
    {
        $this->assertDatabaseCount('abouts', 0);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('section_label', config('home_content.about.section_label'))
            ->assertJsonPath('headline', config('home_content.about.headline'))
            ->assertJsonPath('highlight_word', config('home_content.about.highlight_word'))
            ->assertJsonPath('paragraph_one', config('home_content.about.paragraph_one'))
            ->assertJsonPath('paragraph_two', config('home_content.about.paragraph_two'))
            ->assertJsonPath('image', asset(config('home_content.about.image')))
            ->assertJsonPath('stats.0.number', '15+')
            ->assertJsonPath('stats.0.label', 'YEARS EXPERIENCE')
            ->assertJsonPath('stats.1.number', '1000+')
            ->assertJsonPath('stats.1.label', 'HAPPY CLIENTS');
    }

    public function test_about_prefers_stored_values_including_image_and_stats(): void
    {
        About::create([
            'section_label' => 'CUSTOM LABEL',
            'headline' => 'CUSTOM HEADLINE',
            'highlight_word' => 'CUSTOM',
            'paragraph_one' => 'One',
            'paragraph_two' => 'Two',
            'stat_one_number' => '20+',
            'stat_one_label' => 'YEARS',
            'stat_two_number' => '50+',
            'stat_two_label' => 'PROJECTS',
            'image' => 'upload/about_image/factory.jpg',
        ]);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('section_label', 'CUSTOM LABEL')
            ->assertJsonPath('headline', 'CUSTOM HEADLINE')
            ->assertJsonPath('highlight_word', 'CUSTOM')
            ->assertJsonPath('paragraph_one', 'One')
            ->assertJsonPath('paragraph_two', 'Two')
            ->assertJsonPath('image', asset('upload/about_image/factory.jpg'))
            ->assertJsonPath('stats.0.number', '20+')
            ->assertJsonPath('stats.0.label', 'YEARS')
            ->assertJsonPath('stats.1.number', '50+')
            ->assertJsonPath('stats.1.label', 'PROJECTS');
    }

    public function test_about_falls_back_per_field_when_a_stored_value_is_null(): void
    {
        About::create([
            'headline' => null,
            'stat_one_number' => null,
            'image' => null,
        ]);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('headline', config('home_content.about.headline'))
            ->assertJsonPath('stats.0.number', '15+')
            ->assertJsonPath('image', asset(config('home_content.about.image')));
    }

    public function test_about_leaves_absolute_image_urls_untouched(): void
    {
        About::create(['image' => 'https://cdn.example.com/about.jpg']);

        $this->getJson('/api/about')
            ->assertOk()
            ->assertJsonPath('image', 'https://cdn.example.com/about.jpg');
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test --filter=HomeContentApiTest`

Expected: every test fails, because `/api/home-slides`, `/api/about`, and `config('home_content.about')` do not exist.

- [ ] **Step 3: Add the migration**

Create `database/migrations/2026_11_14_000000_add_homepage_fields_to_abouts_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('section_label')->nullable();
            $table->string('headline')->nullable();
            $table->string('highlight_word')->nullable();
            $table->text('paragraph_one')->nullable();
            $table->text('paragraph_two')->nullable();
            $table->string('stat_one_number', 50)->nullable();
            $table->string('stat_one_label', 100)->nullable();
            $table->string('stat_two_number', 50)->nullable();
            $table->string('stat_two_label', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'section_label',
                'headline',
                'highlight_word',
                'paragraph_one',
                'paragraph_two',
                'stat_one_number',
                'stat_one_label',
                'stat_two_number',
                'stat_two_label',
            ]);
        });
    }
};
```

- [ ] **Step 4: Add the defaults config**

Create `config/home_content.php` with the exact copy currently hardcoded in `AboutSection.vue` and the `/about` page:

```php
<?php

return [
    'about' => [
        'title' => 'About Meksis Engineering',
        'vision' => 'Our vision is to be a market leader in the steel water tank industry through our dedication to providing quality products and the best solutions in the market.',
        'mission' => 'To our customers - we aim to deliver a service in which they can be confident in all aspects: price, delivery and support. To our staff - we aim to deliver a stimulating and rewarding working environment.',
        'description' => "Meksis Engineering was established in 2010. Our primary aim is providing the best steel water tank solutions for our clients by taking advantage of today's modern technology. We form partnerships with our clients to ensure they realize the most gain in terms of advice and economy.",
        'section_label' => 'ABOUT MEKSIS ENGINEERING',
        'headline' => 'PREMIUM STEEL TANK',
        'highlight_word' => 'SOLUTIONS',
        'paragraph_one' => 'Meksis Engineering prides itself as one of the most prominent fabricator, supplier and installer of pressed steel tanks & GRP Tanks in Kenya. We also do general steel fabrication.',
        'paragraph_two' => 'Established in 2010, we specialize in manufacturing high-quality elevated pressed steel tanks, galvanized steel tanks, and GRP water tanks for industrial, commercial, and residential applications across Kenya and East Africa.',
        'stat_one_number' => '15+',
        'stat_one_label' => 'YEARS EXPERIENCE',
        'stat_two_number' => '1000+',
        'stat_two_label' => 'HAPPY CLIENTS',
        'image' => '/images/about/tank-factory.jpeg',
    ],
];
```

- [ ] **Step 5: Add the API controller**

Create `app/Http/Controllers/Api/HomeContentController.php` with `slides(): JsonResponse` and `about(): JsonResponse`, following `App\Http\Controllers\Api\FaqController` conventions.

- `slides()` maps `HomeSlider::query()->orderBy('id')->get()` to `{ id, title, description: short_description, image }`.
- `about()` reads `About::query()->first()` and returns `$about?->{$field} ?? config("home_content.about.{$field}")` for each content field.
- Image resolution is a private helper: `null`/empty returns `null`; a value starting with `http://` or `https://` is returned unchanged; anything else goes through `asset()`.
- In `about()`, a null image resolves to `asset(config('home_content.about.image'))`, not `null`.

- [ ] **Step 6: Register the API routes**

In `routes/api.php`, import the controller and add:

```php
Route::get('/home-slides', [HomeContentController::class, 'slides']);
Route::get('/about', [HomeContentController::class, 'about']);
```

- [ ] **Step 7: Run the API tests to verify they pass**

Run: `php artisan test --filter=HomeContentApiTest`

Expected: 7 passed.

- [ ] **Step 8: Commit**

```bash
git add tests/Feature/HomeContentApiTest.php database/migrations/2026_11_14_000000_add_homepage_fields_to_abouts_table.php config/home_content.php app/Http/Controllers/Api/HomeContentController.php routes/api.php
git commit -m "feat: add home content api and about defaults"
```

---

### Task 2: Editable About admin and protected about routes

**Files:**
- Modify: `app/Http/Controllers/BackOffice/AboutController.php`
- Modify: `resources/views/admin/backOffice/about/add_about.blade.php`
- Modify: `resources/views/admin/partials/left_sidebar.blade.php`
- Modify: `routes/web.php`
- Test: `tests/Feature/BackOffice/AboutAdminTest.php`

**Interfaces:**
- Consumes: `config('home_content.about')` and the new `abouts` columns from Task 1.
- Produces: `AboutController::AboutPage()` creates the single row via `About::query()->firstOrCreate([], config('home_content.about'))`.
- Produces: `AboutController::UpdateAbout()` validates and persists all homepage fields plus `title`, `vision`, `mission`, `description`; image optional.
- Produces: `route('edit.about.page')` and `route('update.about')` require an authenticated, verified user.

- [ ] **Step 1: Write the failing admin tests**

Create `tests/Feature/BackOffice/AboutAdminTest.php`:

```php
<?php

namespace Tests\Feature\BackOffice;

use App\Models\BackOffice\About;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_about_admin_routes(): void
    {
        $this->get(route('edit.about.page'))->assertRedirect(route('login'));
        $this->post(route('update.about'), [])->assertRedirect(route('login'));
    }

    public function test_the_screen_creates_the_row_and_renders_the_effective_defaults(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseCount('abouts', 0);

        $this->actingAs($user)
            ->get(route('edit.about.page'))
            ->assertOk()
            ->assertSee(config('home_content.about.headline'))
            ->assertSee(config('home_content.about.paragraph_one'));

        $this->assertDatabaseCount('abouts', 1);
    }

    public function test_an_admin_can_save_the_homepage_and_about_page_fields(): void
    {
        $user = User::factory()->create();
        $about = About::create(['title' => 'Old']);

        $this->actingAs($user)->post(route('update.about'), [
            'id' => $about->id,
            'title' => 'About title',
            'vision' => 'Vision',
            'mission' => 'Mission',
            'description' => 'Description',
            'section_label' => 'Label',
            'headline' => 'Headline',
            'highlight_word' => 'Highlight',
            'paragraph_one' => 'First paragraph',
            'paragraph_two' => 'Second paragraph',
            'stat_one_number' => '20+',
            'stat_one_label' => 'YEARS',
            'stat_two_number' => '50+',
            'stat_two_label' => 'PROJECTS',
        ])->assertRedirect();

        $this->assertDatabaseHas('abouts', [
            'id' => $about->id,
            'title' => 'About title',
            'vision' => 'Vision',
            'mission' => 'Mission',
            'description' => 'Description',
            'section_label' => 'Label',
            'headline' => 'Headline',
            'highlight_word' => 'Highlight',
            'paragraph_one' => 'First paragraph',
            'paragraph_two' => 'Second paragraph',
            'stat_one_number' => '20+',
            'stat_one_label' => 'YEARS',
            'stat_two_number' => '50+',
            'stat_two_label' => 'PROJECTS',
        ]);
    }

    public function test_saving_without_a_new_image_preserves_the_existing_image(): void
    {
        $user = User::factory()->create();
        $about = About::create([
            'image' => 'upload/about_image/keep.jpg',
            'headline' => 'Old headline',
        ]);

        $this->actingAs($user)->post(route('update.about'), [
            'id' => $about->id,
            'headline' => 'New headline',
        ])->assertRedirect();

        $this->assertDatabaseHas('abouts', [
            'id' => $about->id,
            'headline' => 'New headline',
            'image' => 'upload/about_image/keep.jpg',
        ]);
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test --filter=AboutAdminTest`

Expected: the guest test fails (routes are open, so GET returns 200 instead of a redirect), the create test fails (`About::find(1)` is `null` and the view errors on `$about->id`), and the save tests fail because the new fields are ignored.

- [ ] **Step 3: Update `AboutController::AboutPage()`**

Replace `About::find(1)` with:

```php
$about = About::query()->firstOrCreate([], config('home_content.about'));
```

- [ ] **Step 4: Update `AboutController::UpdateAbout()`**

Add `use Illuminate\Support\Facades\File;`. Validate:

```php
$validated = $request->validate([
    'id' => 'required|integer',
    'title' => 'nullable|string|max:255',
    'vision' => 'nullable|string|max:255',
    'mission' => 'nullable|string|max:255',
    'description' => 'nullable|string',
    'section_label' => 'nullable|string|max:255',
    'headline' => 'nullable|string|max:255',
    'highlight_word' => 'nullable|string|max:255',
    'paragraph_one' => 'nullable|string',
    'paragraph_two' => 'nullable|string',
    'stat_one_number' => 'nullable|string|max:50',
    'stat_one_label' => 'nullable|string|max:100',
    'stat_two_number' => 'nullable|string|max:50',
    'stat_two_label' => 'nullable|string|max:100',
    'about_image' => 'nullable|image',
]);
```

Build the persist array from `$validated` for every key except `id` and `about_image`, then:

- Image branch: `File::ensureDirectoryExists(public_path('upload/about_image'));`, resize to `669x499`, save to `public_path('upload/about_image/' . $name_gen)`, keep the stored URL `upload/about_image/' . $name_gen`, and merge `['image' => $save_url]`.
- No-image branch: persist the same fields without touching `image`.
- Both branches keep the existing flash messages and `redirect()->back()`.

- [ ] **Step 5: Rework the About admin view**

In `resources/views/admin/backOffice/about/add_about.blade.php`:

- Add a "Homepage About Section" heading, then inputs for the nine fields in spec order (label, headline, highlight, two paragraph textareas, two stat number/label pairs), plus the existing `about_image` file input.
- Each input value uses `old('field', $about->field ?? config('home_content.about.field'))`; the paragraph textareas use the same expression as their content.
- Add an "About Page Content" heading above the existing `title`, `vision`, `mission`, `description` fields, and give each one `old('title', $about->title ?? config('home_content.about.title'))` style prefill.
- Replace the broken preview `src` with:
  `src="{{ $about->image ? asset($about->image) : asset(config('home_content.about.image')) }}"`
  and alt text `About image`.
- Guard TinyMCE: only call `tinymce.init({...})` when `typeof tinymce !== 'undefined'`, and read the description as
  `var editor = typeof tinymce !== 'undefined' ? tinymce.get('description-input') : null;`
  `var description = editor ? editor.getContent() : $('#description-input').val();`
- Keep the existing toastr setup and JS validation; with defaults prefilled, the required checks pass on first save.

- [ ] **Step 6: Rename the sidebar group**

In `resources/views/admin/partials/left_sidebar.blade.php`, change the `ABOUT PAGE` group label to `ABOUT & HOMEPAGE` and the `About Content` item to `About & Homepage Content`. Route names stay the same.

- [ ] **Step 7: Protect the about admin routes**

In `routes/web.php`, replace the current `AboutController` group with:

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('update/about/page', [AboutController::class, 'UpdateAbout'])->name('update.about');
    Route::get('edit/about/page', [AboutController::class, 'AboutPage'])->name('edit.about.page');
});

Route::controller(AboutController::class)->group(function () {
    //frontend
    Route::get('about', 'About')->name('about');
    Route::get('pricing_and_packages', 'Pricing')->name('pricing');
});
```

Remove the stale commented `->middleware(['auth', 'verified'])` lines around this block. Do not change route names or URIs.

- [ ] **Step 8: Run the admin tests to verify they pass**

Run: `php artisan test --filter=AboutAdminTest`

Expected: 4 passed.

- [ ] **Step 9: Commit**

```bash
git add tests/Feature/BackOffice/AboutAdminTest.php app/Http/Controllers/BackOffice/AboutController.php resources/views/admin/backOffice/about/add_about.blade.php resources/views/admin/partials/left_sidebar.blade.php routes/web.php
git commit -m "feat: make homepage about editable from admin"
```

---

### Task 3: Fix the Home Slider admin and protect its routes

**Files:**
- Modify: `app/Http/Controllers/BackOffice/AdminController.php`
- Modify: `resources/views/admin/backOffice/homeslider/add_homeslider.blade.php`
- Modify: `resources/views/admin/backOffice/homeslider/edit_homeslider.blade.php`
- Modify: `resources/views/admin/backOffice/homeslider/index_homeslider.blade.php`
- Modify: `routes/web.php`
- Test: `tests/Feature/BackOffice/HomeSliderAdminTest.php`

**Interfaces:**
- Consumes: the existing `home_sliders` table and `HomeSlider` model.
- Produces: `AdminController::UpdateSlider()` handles the no-image branch without touching `home_slide`.
- Produces: the slider admin routes require an authenticated, verified user.
- Produces: the hero editor can store uploaded images under `public/upload/home_slide/`.

- [ ] **Step 1: Write the failing admin tests**

Create `tests/Feature/BackOffice/HomeSliderAdminTest.php`:

```php
<?php

namespace Tests\Feature\BackOffice;

use App\Models\BackOffice\HomeSlider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeSliderAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_from_slider_admin_routes(): void
    {
        $this->get(route('index.slider'))->assertRedirect(route('login'));
        $this->get(route('home.slider'))->assertRedirect(route('login'));
        $this->post(route('update.slider'), [])->assertRedirect(route('login'));
    }

    public function test_an_admin_can_update_a_slide_without_a_new_image(): void
    {
        $user = User::factory()->create();
        $slide = HomeSlider::create([
            'title' => 'Old title',
            'short_description' => 'Old description',
            'home_slide' => 'upload/home_slide/keep.jpg',
        ]);

        $this->actingAs($user)->post(route('update.slider'), [
            'id' => $slide->id,
            'title' => 'New title',
            'short_title' => 'New description',
            'video_url' => 'https://example.com/video',
        ])->assertRedirect(route('index.slider'));

        $this->assertDatabaseHas('home_sliders', [
            'id' => $slide->id,
            'title' => 'New title',
            'short_description' => 'New description',
            'video_url' => 'https://example.com/video',
            'home_slide' => 'upload/home_slide/keep.jpg',
        ]);
    }

    public function test_the_slider_list_renders_an_empty_state_hint(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('index.slider'))
            ->assertOk()
            ->assertSee('built-in default hero');
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test --filter=HomeSliderAdminTest`

Expected: the guest test fails (GET returns 200), the update test fails with `Class "App\Http\Controllers\BackOffice\Customer" not found` (or `Undefined variable $customer_id`), and the empty-state test fails.

- [ ] **Step 3: Fix `AdminController::UpdateSlider()`**

Replace the no-image branch's `Customer::findOrfail($customer_id)->update([...])` with `HomeSlider::findOrfail($homeslider_id)->update([...])`, keeping `title`, `short_description`, `video_url`, and `updated_at`. Do not touch `home_slide` in that branch.

- [ ] **Step 4: Make both upload branches write under `public/`**

Add `use Illuminate\Support\Facades\File;`. In `StoreSlider` and the image branch of `UpdateSlider`, before saving:

```php
File::ensureDirectoryExists(public_path('upload/home_slide'));
```

and save to `public_path('upload/home_slide/' . $name_gen)`. Keep the stored value `upload/home_slide/' . $name_gen`.

- [ ] **Step 5: Fix the slider views**

- `edit_homeslider.blade.php`: preview becomes
  `src="{{ $homeslide->home_slide ? asset($homeslide->home_slide) : asset('upload/no_image.jpg') }}"`
  and the submit label becomes `Update Home Slider`.
- `add_homeslider.blade.php`: preview becomes `src="{{ asset('upload/no_image.jpg') }}"`.
- `index_homeslider.blade.php`:
  - Guard the row image: `src="{{ $item->home_slide ? asset($item->home_slide) : asset('upload/no_image.jpg') }}"`.
  - After the `<h4>`, add:
    `@if ($homeslides->isEmpty()) <p class="text-muted">No slides yet — the site is showing the built-in default hero until you add one.</p> @endif`
  - Change the per-row delete link from `id="delete"` to `class="delete-confirm"`, and the handler from `$('#delete').on('click', ...)` to `$('.delete-confirm').on('click', ...)`.

- [ ] **Step 6: Protect the slider admin routes**

In `routes/web.php`, wrap the six slider routes and `admin/logout` in `Route::middleware(['auth', 'verified'])->group(...)`. Keep every method, URI, controller action, and route name exactly as it is. Remove the stale commented middleware lines nearby.

- [ ] **Step 7: Run the admin tests to verify they pass**

Run: `php artisan test --filter=HomeSliderAdminTest`

Expected: 3 passed.

- [ ] **Step 8: Commit**

```bash
git add tests/Feature/BackOffice/HomeSliderAdminTest.php app/Http/Controllers/BackOffice/AdminController.php resources/views/admin/backOffice/homeslider routes/web.php
git commit -m "fix: make slider admin edits work without a new image"
```

---

### Task 4: Wire the hero, About block, and landing contact section

**Files:**
- Modify: `resources/js/components/HeroSection.vue`
- Modify: `resources/js/components/AboutSection.vue`
- Modify: `resources/js/pages/Welcome.vue`
- Test: `tests/Feature/HomeContentFrontendTest.php`

**Interfaces:**
- Consumes: `GET /api/home-slides` and `GET /api/about` from Task 1.
- Produces: the landing renders database slides when present, the four built-in slides otherwise, the About content with fallbacks, and `ContactSection` as the final section after `FaqsSection`.

- [ ] **Step 1: Write the failing static wiring tests**

Create `tests/Feature/HomeContentFrontendTest.php`:

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeContentFrontendTest extends TestCase
{
    public function test_the_hero_and_about_components_fetch_their_api_endpoints(): void
    {
        $hero = file_get_contents(base_path('resources/js/components/HeroSection.vue'));
        $about = file_get_contents(base_path('resources/js/components/AboutSection.vue'));

        $this->assertStringContainsString('/api/home-slides', $hero);
        $this->assertStringContainsString('/api/about', $about);
    }

    public function test_every_hero_fallback_image_exists(): void
    {
        $hero = file_get_contents(base_path('resources/js/components/HeroSection.vue'));
        preg_match_all("#['\"]/images/hero/([^'\"]+)['\"]#", $hero, $matches);

        $this->assertNotEmpty($matches[1]);

        foreach ($matches[1] as $file) {
            $this->assertFileExists(public_path('images/hero/' . $file));
        }
    }

    public function test_the_about_fallback_image_exists(): void
    {
        $this->assertFileExists(
            public_path(ltrim(config('home_content.about.image'), '/'))
        );
    }

    public function test_the_landing_renders_the_contact_section_after_the_faqs(): void
    {
        $welcome = file_get_contents(base_path('resources/js/pages/Welcome.vue'));

        $faqsPosition = strpos($welcome, '<FaqsSection />');
        $contactPosition = strpos($welcome, '<ContactSection />');

        $this->assertNotFalse($faqsPosition);
        $this->assertNotFalse($contactPosition);
        $this->assertGreaterThan($faqsPosition, $contactPosition);
    }
}
```

- [ ] **Step 2: Run the tests to verify they fail**

Run: `php artisan test --filter=HomeContentFrontendTest`

Expected: the API-string tests fail, the hero image test fails on `steel-fabrication.jpg`, and the contact order test fails.

- [ ] **Step 3: Wire `HeroSection.vue`**

Keep the current four slides as `defaultSlides` and initialize `slides: defaultSlides`. In `mounted()`, call `this.fetchSlides()` and `this.startAutoplay()`.

- `fetchSlides()`: `fetch('/api/home-slides')`; if `res.ok`, replace `this.slides` with `data.slides` only when it is a non-empty array and reset `this.currentSlide = 0`; restart autoplay after replacing. On any error, leave the defaults in place and `console.error`.
- `startAutoplay()`: clear any existing interval first and only set a 5-second interval when `this.slides.length > 1`.
- `nextSlide()`: return early when `this.slides.length === 0`; otherwise keep the modulo behavior.
- `goToSlide(index)`: keep the stop/start behavior.
- Slide key becomes `:key="slide.id ?? index"`.
- Image style becomes `:style="{ backgroundImage: slide.image ? \`url(${slide.image})\` : 'none' }"`.
- Change the fourth fallback image from `/images/hero/steel-fabrication.jpg` to the existing `/images/hero/tank-hero.jpg`.
- Keep both buttons and the rest of the template unchanged.

- [ ] **Step 4: Wire `AboutSection.vue`**

Convert the empty `<script setup>` into a data-driven block:

- `defaultContent` object with the exact current copy and stats (same values as `config/home_content.php`), plus `image: '/images/about/tank-factory.jpeg'`.
- `const content = ref(defaultContent)`.
- `onMounted`: `fetch('/api/about')`; on success merge the response over the defaults, keep `defaultContent.image` when `data.image` is falsy, and keep `defaultContent.stats` when `data.stats` is missing or empty; on error, `console.error` and keep the defaults.
- Template bindings: image `:src="content.image"`; label `{{ content.section_label }}`; headline `{{ content.headline }}`; highlight `{{ content.highlight_word }}`; both paragraphs `{{ content.paragraph_one }}` and `{{ content.paragraph_two }}`; stats with
  ```vue
  <template v-for="(stat, index) in content.stats" :key="index">
    <div v-if="index > 0" class="stat-divider"></div>
    <div class="stat-item">
      <div class="stat-number">{{ stat.number }}</div>
      <div class="stat-label">{{ stat.label }}</div>
    </div>
  </template>
  ```
- Keep the alt text and both CTA buttons unchanged.

- [ ] **Step 5: Wire `Welcome.vue`**

Import `ContactSection` and render it last:

```vue
<HeroSection />
<ServicesSection />
<AboutSection />
<BlogSection />
<FaqsSection />
<ContactSection />
```

Remove the unused `faHotTubPerson` import.

- [ ] **Step 6: Run the static tests to verify they pass**

Run: `php artisan test --filter=HomeContentFrontendTest`

Expected: 4 passed.

- [ ] **Step 7: Build the frontend**

Run: `npm run build` (on Windows PowerShell use `npm.cmd run build`).

Expected: build succeeds with no Vue compile errors.

- [ ] **Step 8: Run the full suite**

Run: `php artisan test`

Expected: 60 passed (42 existing + 7 API + 4 About admin + 3 slider admin + 4 frontend); the only failures are the five known legacy auth tests.

- [ ] **Step 9: Commit**

```bash
git add tests/Feature/HomeContentFrontendTest.php resources/js/components/HeroSection.vue resources/js/components/AboutSection.vue resources/js/pages/Welcome.vue
git commit -m "feat: wire editable hero and about into the landing page"
```

## Manual verification

- Run `php artisan migrate` and `npm run build`.
- Open `/` as a guest: the hero shows the built-in four slides (no 404 images), the About block shows the default copy, and the contact / get-a-quote section is the last section below the FAQs.
- Add two slides in the admin (images optional), reload `/`: only the database slides render, in id order, and autoplay shows both. Delete them and reload: the four built-ins return.
- Edit a slide title without choosing a new image; save; reload `/`: the title changes and the old image stays.
- Edit the About homepage fields in the admin (including clearing one); save; reload `/`: the edited values render and the cleared field shows its default.
- Upload an About image and a slide image; both save without a missing-directory error and render from `/upload/...`.
- Open the About admin form with TinyMCE blocked (DevTools request blocking) and save: the form still submits.
- Confirm `/about` is unchanged and guests are redirected from `/jamalhaji`-protected admin URLs.

## Deployment note

Run `php artisan migrate` and `npm run build` on the target deployment. No seeder is required: the About admin creates the single `abouts` row on first visit and the API falls back to `config/home_content.php` until then; an empty `home_sliders` table keeps the built-in hero.
