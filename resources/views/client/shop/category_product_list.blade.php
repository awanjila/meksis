@extends('client.layout.app')
@section('title')
{{ $category->category_name }} | Meksis Engineering
@endsection

@section('meta_title')
{{ $category->category_name }} | Shop Meksis Engineering
@endsection

@section('meta_description')
Browse {{ $category->category_name }} products from Meksis Engineering and add them to your cart.
@endsection
@section('content')

<section class="shop-section">
    <div class="shop-container">
        <div class="shop-header">
            <h1 class="shop-title">{{ $category->category_name }}</h1>
            <p class="shop-subtitle">Browse {{ $category->category_name }} products and add what you need to your cart</p>
        </div>

        <div class="shop-filters">
            <a href="/store" class="shop-filter">All</a>
            @foreach($categories as $cat)
                <a href="{{ route('category.products', $cat->slug) }}" class="shop-filter {{ $cat->id === $category->id ? 'active' : '' }}">{{ $cat->category_name }}</a>
            @endforeach
        </div>

        <p class="shop-count">{{ $items->count() }} {{ \Illuminate\Support\Str::plural('product', $items->count()) }} available</p>

        <div class="shop-grid">
            @forelse($items as $product)
                <product-card :product='@json($product)'></product-card>
            @empty
                <div class="shop-empty">
                    <p>No products are available in this category yet.</p>
                    <a class="shop-empty-cta" target="_blank" rel="noopener" href="https://wa.me/254735551515?text={{ urlencode("Hi Meksis, I'm looking for " . $category->category_name . " products") }}">Ask us on WhatsApp</a>
                </div>
            @endforelse
        </div>

        <shop-trust-bar></shop-trust-bar>
    </div>
</section>

<faqs-section></faqs-section>


@endsection
