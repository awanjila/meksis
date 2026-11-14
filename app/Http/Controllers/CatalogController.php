<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{

    public function index(): View
    {
        $products = Product::latest()
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

    public function showByCategory($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
    $items = Product::where('category_id', $category->id)
        ->get()
        ->filter(fn (Product $product) => $product->isOrderable())
        ->values();

    return view('client.shop.category_product_list', compact('category', 'items'));
}//endmethod


public function show($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();

      // Retrieve the category associated with the product
    $category = $product->category;

    $products = Product::where('category_id', $category->id)
                        ->where('id', '!=', $product->id)
                        ->get()
                        ->filter(fn (Product $item) => $item->isOrderable())
                        ->values();


    return view('client.shop.shop_product', compact('product', 'products'));
}//endmethod

    public function showCart(): View
    {
        return view('client.shop.cart');
    }

    public function checkout(): View
    {
        return view('client.shop.checkout');
    }
}
