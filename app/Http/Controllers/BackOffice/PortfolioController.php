<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\Portfolio;
use App\Models\BackOffice\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function IndexOfPortfolioCategories()
    {
        $categories = PortfolioCategory::all();
        return view('admin.backOffice.portfolio.portfolio_category', compact('categories'));
    }

    public function StorePortfolioCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        PortfolioCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Portfolio Category added successfully!');
    }

    public function EditPortfolioCategory($id)
    {
        $category = PortfolioCategory::findOrFail($id);
        return view('admin.backOffice.portfolio.edit_portfolio_category', compact('category'));
    }

    public function UpdatePortfolioCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:portfolio_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = PortfolioCategory::findOrFail($request->id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('portfolio.category')->with('success', 'Portfolio Category updated successfully!');
    }

    public function DeletePortfolioCategory($id)
    {
        $category = PortfolioCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Portfolio Category deleted successfully!');
    }

    public function IndexOfPortfolios()
    {
        $portfolios = Portfolio::with('category')->get();
        $categories = PortfolioCategory::all();
        return view('admin.backOffice.portfolio.portfolio', compact('portfolios', 'categories'));
    }

    public function StorePortfolio(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:portfolio_categories,id',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'live_url' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'key_features' => 'nullable|string',
            'featured' => 'nullable|boolean',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/portfolio_images'), $imageName);
                $imagePaths[] = 'upload/portfolio_images/' . $imageName;
            }
        }

        Portfolio::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'images' => $imagePaths,
            'live_url' => $request->live_url,
            'tech_stack' => $request->tech_stack ? json_decode($request->tech_stack, true) : null,
            'key_features' => $request->key_features,
            'featured' => $request->featured ?? false,
        ]);

        return redirect()->back()->with('success', 'Portfolio added successfully!');
    }

    public function EditPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $categories = PortfolioCategory::all();
        return view('admin.backOffice.portfolio.edit_portfolio', compact('portfolio', 'categories'));
    }

    public function UpdatePortfolio(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:portfolios,id',
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:portfolio_categories,id',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'live_url' => 'nullable|url',
            'tech_stack' => 'nullable|string',
            'key_features' => 'nullable|string',
            'featured' => 'nullable|boolean',
        ]);

        $portfolio = Portfolio::findOrFail($request->id);

        $imagePaths = $portfolio->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/portfolio_images'), $imageName);
                $imagePaths[] = 'upload/portfolio_images/' . $imageName;
            }
        }

        $portfolio->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'images' => $imagePaths,
            'live_url' => $request->live_url,
            'tech_stack' => $request->tech_stack ? json_decode($request->tech_stack, true) : null,
            'key_features' => $request->key_features,
            'featured' => $request->featured ?? false,
        ]);

        return redirect()->route('portfolio')->with('success', 'Portfolio updated successfully!');
    }

    public function DeletePortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // Delete associated images
        if ($portfolio->images) {
            foreach ($portfolio->images as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        $portfolio->delete();

        return redirect()->back()->with('success', 'Portfolio deleted successfully!');
    }

    public function getPortfolioCategories()
    {
        $categories = PortfolioCategory::withCount('portfolios')
            ->with(['portfolios' => function($query) {
                $query->inRandomOrder()->limit(1);
            }])
            ->get()
            ->map(function($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'description' => $category->description,
                    'random_image' => $category->portfolios->first() ? $category->portfolios->first()->images[0] ?? null : null,
                    'portfolios_count' => $category->portfolios_count,
                ];
            });

        return response()->json($categories);
    }

    public function getPortfoliosByCategory($categorySlug)
    {
        $category = PortfolioCategory::where('slug', $categorySlug)->firstOrFail();

        $portfolios = $category->portfolios()->with('category')->get()->map(function($portfolio) {
            return [
                'id' => $portfolio->id,
                'title' => $portfolio->title,
                'description' => $portfolio->description,
                'images' => $portfolio->images,
                'live_url' => $portfolio->live_url,
                'tech_stack' => $portfolio->tech_stack,
                'key_features' => $portfolio->key_features,
                'featured' => $portfolio->featured,
                'category' => [
                    'name' => $portfolio->category->name,
                    'slug' => $portfolio->category->slug,
                ],
                'created_at' => $portfolio->created_at,
            ];
        });

        return response()->json([
            'category' => [
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
            ],
            'portfolios' => $portfolios,
        ]);
    }

    public function ShowCategoryPortfolios($slug)
    {
        $category = PortfolioCategory::where('slug', $slug)->firstOrFail();
        return view('client.ourwork.portfolio_details', [
            'category' => $category,
            'categorySlug' => $slug
        ]);
    }
}
