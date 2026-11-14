@extends('client.layout.app')
@section('title')
Meksis Engineering | Advanced Security Solutions
@endsection

@section('meta_title')
Shop | Meksis Engineering
@endsection

@section('meta_description')
Browse orderable products from Meksis Engineering and add them to your cart.
@endsection
@section('content')

<section class="shop-section">
    <div class="shop-container">
        <div class="shop-header">
            <h1 class="shop-title">OUR SHOP</h1>
            <p class="shop-subtitle">Browse our products and add what you need to your cart</p>
        </div>

        <div class="shop-filters">
            <a href="/store" class="shop-filter active">All</a>
            @foreach($categories as $category)
                <a href="{{ route('category.products', $category->slug) }}" class="shop-filter">{{ $category->category_name }}</a>
            @endforeach
        </div>

        <p class="shop-count">{{ $products->count() }} {{ \Illuminate\Support\Str::plural('product', $products->count()) }} available</p>

        <div class="shop-grid">
            @forelse($products as $product)
                <product-card :product='@json($product)'></product-card>
            @empty
                <div class="shop-empty">
                    <p>No products are available yet.</p>
                    <a class="shop-empty-cta" target="_blank" rel="noopener" href="https://wa.me/254735551515?text={{ urlencode("Hi Meksis, I'm looking for a product") }}">Ask us on WhatsApp</a>
                </div>
            @endforelse
        </div>

        <shop-trust-bar></shop-trust-bar>
    </div>
</section>

<faqs-section></faqs-section>


@endsection
