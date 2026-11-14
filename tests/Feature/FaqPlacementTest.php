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
