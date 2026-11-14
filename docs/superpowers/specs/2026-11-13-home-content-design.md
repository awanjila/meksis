# Editable Landing Hero, Homepage About, and Landing Contact Section - Design

Date: 2026-11-13
Project: Meksis (Laravel 10 + Vue 3 + Vite)

## Intent

Make the landing page's hero and About block editable from the existing admin back office, and add the existing contact / get-a-quote section to the landing page. Visitors see the same design; the owner can change the words and images without a code change.

## Decisions confirmed with the owner

- The editable About block is the **homepage** `AboutSection.vue` (not the full `/about` page).
- The hero reuses the **existing Home Slider admin** (`home_sliders`). The two hero buttons stay hardcoded.
- The About content model **extends the existing `abouts` table and About admin screen**; one screen edits the homepage block (the `/about` page itself is not wired in this change).
- The contact section goes **after the FAQs**, as the last section on the landing page.
- Content is delivered through **small read-only API endpoints**, matching the FAQ pattern.
- The existing slider/about admin routes gain **`auth` + `verified`** middleware.

## Goals

- `GET /api/home-slides` returns the ordered hero slides from `home_sliders`.
- `GET /api/about` returns the effective homepage About content (database value, else built-in default).
- `HeroSection.vue` renders the API slides and keeps the current four slides as a fallback when the table is empty or the request fails.
- `AboutSection.vue` renders the API content (label, headline, highlight word, two paragraphs, image, two stats) with a built-in fallback.
- The existing About admin screen edits every homepage About field, plus the pre-existing about-page fields, and fixes its broken image preview.
- The existing Home Slider admin can update a slide without replacing its image (fix the undefined `Customer` branch) and shows the real image preview.
- `Welcome.vue` renders `<ContactSection />` after `<FaqsSection />`.
- Admin routes for sliders and about content require a logged-in, verified user.

## Non-goals

- Wiring the `/about` page (`AboutUs.vue`) to the database. It stays hardcoded.
- A new hero/editor module; the Home Slider module is reused as-is.
- Editable hero buttons, editable CTA buttons, or editable stat icons.
- Slide reordering, activation toggles, or drag-and-drop.
- Rich-text/HTML for About paragraphs; they are plain text.
- Localisation.
- Caching or CDN work.
- Changing the contact form or its `/api/contact` endpoint.

## Anti-goals

- Duplicating the contact form markup on the landing page.
- Hardcoding the same About copy in two places (API defaults are the single server-side source; the Vue fallback mirrors it only for request failure).
- New npm or Composer dependencies.
- Breaking the existing admin layout, sidebar, or the FAQ work.

## Current state (what this touches)

- `resources/js/pages/Welcome.vue` composes `HeroSection`, `ServicesSection`, `AboutSection`, `BlogSection`, and `FaqsSection`. It does not include `ContactSection`.
- `resources/js/components/HeroSection.vue` holds four hardcoded slides (`title`, `description`, `image`) and auto-advances every 5 seconds. The two buttons are hardcoded.
- `resources/js/components/AboutSection.vue` holds the label, headline, highlight word, two paragraphs, image (`/images/about/tank-factory.jpeg`), and two stats (`15+` / `1000+`). The CTAs are hardcoded.
- `resources/js/components/ContactSection.vue` is already used by `resources/js/pages/Contact.vue`; it posts to `/api/contact` with axios.
- `app/Http/Controllers/BackOffice/AdminController.php` has full CRUD for `HomeSlider`. `UpdateSlider`'s no-image branch references undefined `Customer` and `$customer_id`, so saving an edit without a new image crashes.
- `app/Http/Controllers/BackOffice/AboutController.php` edits a single `abouts` row (`About::find(1)`), with no server-side validation. The view pre-fills only `title`, `vision`, `mission`, `description`, and its image preview references undefined `$editData`.
- `database/migrations/2023_06_24_024631_create_abouts_table.php` defines `id`, `title`, `vision`, `mission`, `description`, `image`.
- `database/migrations/2023_06_23_193305_create_home_sliders_table.php` defines `id`, `title`, `short_description`, `home_slide`, `video_url`.
- `routes/web.php` declares the slider and about admin routes outside any middleware group; the intended `auth`/`verified` lines are commented out.
- `routes/api.php` already hosts public read endpoints (`/faqs`, `/blogs`, `/services`) and the contact POST.
- Shared design tokens: `--royal-yellow: rgb(250, 218, 94)`, `--charcoal: rgb(26, 26, 26)`, square corners, uppercase Arial Narrow headings.

## Approaches considered

### A. Small read-only API endpoints (chosen)

`GET /api/home-slides` and `GET /api/about`. Each Vue component fetches its own data on mount and keeps a built-in fallback.

- Pros: matches the existing `/api/faqs` pattern; components stay self-contained and reusable; no route or Blade changes; easy to test.
- Cons: content arrives after the Vue app boots (already true for the whole site); two small requests.

### B. Blade props

Convert the `/` closure to a controller and pass JSON props into `<welcome-page>`, then down to the children.

- Pros: content present on first render; no extra requests.
- Cons: adds a controller, a route change, and prop plumbing; couples the components to the page; fights the existing fetch-based pattern.

### C. Single `/api/home-content` endpoint fetched by `Welcome.vue`

- Pros: one request; no route change.
- Cons: the page has to pass props down to two components; less reusable than A for a small gain.

## Data model

### `abouts` (extended)

Add nullable columns:

| Column | Type | Purpose |
| --- | --- | --- |
| `section_label` | string(255) | Eyebrow above the headline |
| `headline` | string(255) | Headline before the highlight |
| `highlight_word` | string(255) | Yellow highlighted word |
| `paragraph_one` | text | First paragraph |
| `paragraph_two` | text | Second paragraph |
| `stat_one_number` | string(50) | e.g. `15+` |
| `stat_one_label` | string(100) | e.g. `YEARS EXPERIENCE` |
| `stat_two_number` | string(50) | e.g. `1000+` |
| `stat_two_label` | string(100) | e.g. `HAPPY CLIENTS` |

The existing `image` column is reused for the homepage image. `title`, `vision`, `mission`, and `description` remain for the about-page editor and are not consumed by the frontend in this change.

No new table. No `sort_order` on slides; hero order is `id ASC`.

### Defaults

`config/home_content.php` holds the effective defaults, matching today's hardcoded copy exactly:

- `section_label`: `ABOUT MEKSIS ENGINEERING`
- `headline`: `PREMIUM STEEL TANK`
- `highlight_word`: `SOLUTIONS`
- `paragraph_one`: the current first paragraph
- `paragraph_two`: the current second paragraph
- `stat_one_number` / `stat_one_label`: `15+` / `YEARS EXPERIENCE`
- `stat_two_number` / `stat_two_label`: `1000+` / `HAPPY CLIENTS`
- `image`: `/images/about/tank-factory.jpeg`
- `title`, `vision`, `mission`, `description`: the current `/about` page copy, so the existing admin fields are never blank and the form's JS validation stays satisfied

Because `ConvertEmptyStringsToNull` turns a cleared input into `null`, a null field falls back to the default. The API and admin form both apply this rule, so clearing a field restores the built-in copy rather than rendering an empty headline.

## Backend

### API controller

`app/Http/Controllers/Api/HomeContentController.php`:

- `slides(): JsonResponse`
  - `HomeSlider::query()->orderBy('id')->get()`.
  - Map each row to `{ id, title, description, image }`, where `description` is `short_description` and `image` is an absolute URL (`asset($path)`) or `null`.
  - Return `{ "slides": [...] }`; an empty table returns `{ "slides": [] }`.
- `about(): JsonResponse`
  - Read the first `abouts` row (no writes on a public GET).
  - For each field return `$about?->field ?? config('home_content.about.field')`.
  - Image: if the stored image is null, use the config default; resolve relative `upload/...` paths with `asset()` and leave absolute `http(s)://` URLs untouched.
  - Return `{ section_label, headline, highlight_word, paragraph_one, paragraph_two, image, stats: [{number, label}, {number, label}] }`.
- Private helper for image URL resolution, used by both methods.

### Routes

`routes/api.php`:

```php
Route::get('/home-slides', [HomeContentController::class, 'slides']);
Route::get('/about', [HomeContentController::class, 'about']);
```

`routes/web.php`:

- Wrap the slider routes (`home/slider`, `index/slider`, `store/slider`, `update/slider`, `edit/slider/{id}`, `delete/slider/{id}`, `admin/logout`) in `Route::middleware(['auth', 'verified'])->group(...)`.
- Split the about controller group: `update/about/page` and `edit/about/page` inside `auth`/`verified`; the public `about` and `pricing_and_packages` routes stay outside.
- No route names change.

### About admin

`AboutController::AboutPage()`:

- Replace `About::find(1)` with `About::query()->firstOrCreate([], config('home_content.about'))`.
- Pass the row to the existing view.

`AboutController::UpdateAbout()`:

- Add server-side validation: all content fields `nullable|string`; `title`, `vision`, `mission`, `description` keep their current meaning; the new homepage fields are nullable and fall back to defaults when null.
- Persist the new fields on both the image and no-image branches.
- Keep the existing image resize (`669x499`) and upload path (`upload/about_image/`).
- Keep the existing success/warning flash and redirect.

`resources/views/admin/backOffice/about/add_about.blade.php`:

- Add a "Homepage About Section" fieldset with the nine new fields plus the existing image input.
- Pre-fill every input with `old('field', $about->field ?? config('home_content.about.field'))`.
- Keep the existing "About Page Content" fields (`title`, `vision`, `mission`, `description`) below it.
- Fix the image preview to use `$about->image` (falling back to the config default) instead of `$editData->profile_image`.
- Keep the existing toastr setup. The existing TinyMCE script uses a placeholder `API_KEY` and can fail to load; today the submit handler calls `tinymce.get()` unconditionally, which throws and prevents the form from submitting. Guard both the `tinymce.init` call and the `description` read so the plain textarea value is used when TinyMCE is unavailable. The new paragraphs are plain `<textarea>` inputs, not TinyMCE, because they render as plain text on the frontend.

`resources/views/admin/partials/left_sidebar.blade.php`:

- Rename the group to `ABOUT & HOMEPAGE` and the item to `About & Homepage Content`, since one screen now edits both. Route names are unchanged.

### Slider admin fixes

`AdminController::UpdateSlider()`:

- In the no-image branch, replace `Customer::findOrfail($customer_id)` with `HomeSlider::findOrfail($homeslider_id)->update([...])`, preserving `title`, `short_description`, `video_url`, and `updated_at` without touching `home_slide`.

`resources/views/admin/backOffice/homeslider/edit_homeslider.blade.php`:

- Replace the undefined `$editData->profile_image` preview with `$homeslide->home_slide`, falling back to `upload/no_image.jpg`.
- Keep the submit label consistent (`Update Home Slider`).

`resources/views/admin/backOffice/homeslider/add_homeslider.blade.php`:

- Replace the undefined `$editData` preview with the `upload/no_image.jpg` placeholder.

`resources/views/admin/backOffice/homeslider/index_homeslider.blade.php`:

- Show a muted note when the table is empty: the site is currently showing the built-in default hero until a slide is added.
- Change the repeated `id="delete"` to a class so the confirm handler applies to every row.

## Frontend

### `resources/js/components/HeroSection.vue`

- Keep the current four slides as `defaultSlides`.
- `slides` starts as `defaultSlides`; `onMounted` fetches `/api/home-slides`.
- On a successful response with at least one slide, replace `slides` and reset `currentSlide` to `0`.
- On an empty response or an error, keep the defaults.
- Key slides by `slide.id` (falling back to the index).
- Only start the 5-second interval when there is more than one slide; guard against an empty array.
- Image binding stays `:style="{ backgroundImage: slide.image ? \`url(${slide.image})\` : 'none' }"`.
- Two of the four fallback image paths are broken today: `public/images/hero/elevated-tanks.jpg` and `public/images/hero/tank-installation.jpg` do not exist. Point both fallback slides at the existing `public/images/hero/tank-hero.jpg` so the default hero has no 404 images.
- The `Contact Us` and `Our Products` buttons stay hardcoded.

### `resources/js/components/AboutSection.vue`

- Define `defaultContent` matching the current hardcoded copy and stats.
- `content` starts as `defaultContent`; `onMounted` fetches `/api/about` and replaces it on success.
- Bind the label, headline, highlight word, both paragraphs, the image, and the two stats.
- Render stats with `v-for` over `content.stats`; show the divider between items only.
- Keep the CTAs hardcoded.
- Image falls back to `/images/about/tank-factory.jpeg` if the API omits it.
- Alt text stays "Meksis Engineering Steel Tank Manufacturing".

### `resources/js/pages/Welcome.vue`

- Import `ContactSection` and render it after `<FaqsSection />`:

```vue
<HeroSection />
<ServicesSection />
<AboutSection />
<BlogSection />
<FaqsSection />
<ContactSection />
```

- `ContactSection` already has `id="contact"` and posts to `/api/contact`; no changes to it.

## Error and empty states

- Hero API empty: show the built-in four slides.
- Hero API failure: keep the built-in four slides; no visible error.
- About API failure: keep the built-in copy; no visible error.
- About field null/blank: server returns the config default.
- About image null: server returns the config default image.
- Slide image null: the slide renders on the dark section background with the existing overlay; no broken image icon.

## Constraints and conventions

- Laravel 10, Vue 3, Vite. No new npm or Composer dependencies.
- Public reads go through `/api/*`; admin writes stay in Blade controllers.
- Admin screens use the existing `admin.admin_master` layout, session flash, and toastr.
- The admin routes gain `auth` + `verified`, matching the FAQ admin.
- Tests use the SQLite `:memory:` configuration in `phpunit.xml`.
- Do not commit `public/build`, `storage/logs/laravel.log`, or `bootstrap/cache/` changes.

## Testing

- `tests/Feature/HomeContentApiTest.php`
  - Slides are ordered by id and return absolute image URLs.
  - Slides return an empty array when the table is empty.
  - About returns the config defaults when no row exists.
  - About prefers stored values, including the image URL and both stats.
- `tests/Feature/BackOffice/AboutAdminTest.php`
  - Guests are redirected from the about admin routes.
  - The screen creates the row when missing and renders the effective defaults.
  - An admin can save the homepage fields and the existing about fields.
  - An admin can save without a new image and the existing image is preserved.
- `tests/Feature/BackOffice/HomeSliderAdminTest.php`
  - Guests are redirected from the slider admin routes.
  - An admin can update a slide without a new image (regression for the undefined `Customer` branch).
- Image upload through Intervention Image is verified manually; the automated tests cover the no-image branch to avoid writing files into `public/upload` during the suite.

## Deployment note

Run `php artisan migrate` and `npm run build` on the target deployment. No seeder is required: the About admin screen creates the single `abouts` row on first visit, and the API falls back to `config/home_content.php` until then.

## What is left to the builder

- Exact admin fieldset markup and spacing.
- Whether the About image preview uses the existing `avatar-lg` class or a wider preview.
- Exact wording of the empty-slider hint.
- Whether to hide a stat when its number or label is blank (the design keeps both stats visible with defaults).
- Whether the hero should show a subtle loading state (the design keeps the defaults visible until the fetch resolves).
