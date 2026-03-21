<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class Catalogcontroller extends Controller
{
    
    public function showByCategory($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
    $items = Product::where('category_id', $category->id)->get();

    return view('client.shop.category_product_list', compact('category', 'items'));
}//endmethod


public function show($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();

      // Retrieve the category associated with the product
    $category = $product->category;

    $products = Product::where('category_id', $category->id)
                        ->where('id', '!=', $product->id)
                        ->get();


    return view('client.shop.shop_product', compact('product', 'products'));
}//endmethod
}
