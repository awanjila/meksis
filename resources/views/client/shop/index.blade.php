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

<style>
.shop-section {
    padding: 60px 0 40px;
    background: var(--white);
}

.shop-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 50px;
}

.shop-header {
    text-align: center;
    margin-bottom: 40px;
}

.shop-title {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--charcoal);
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 16px;
}

.shop-subtitle {
    color: #666;
    font-size: 1rem;
    text-transform: uppercase;
    font-weight: bold;
}

.shop-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-bottom: 40px;
}

.shop-filter {
    padding: 8px 16px;
    font-size: 14px;
    color: var(--charcoal);
    background: #f5f5f5;
    border: 1px solid #e0e0e0;
    text-decoration: none;
    text-transform: uppercase;
    transition: background 0.2s, border-color 0.2s;
}

.shop-filter:hover,
.shop-filter.active {
    background: var(--royal-yellow);
    border-color: var(--royal-yellow);
    color: var(--charcoal);
}

.shop-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.shop-count {
    font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
    font-size: 12px;
    color: #888;
    margin-bottom: 20px;
}

.shop-empty {
    grid-column: 1 / -1;
    text-align: center;
    color: #666;
    padding: 48px 20px;
    border: 1px solid #e5e5e5;
}

.shop-empty-cta {
    display: inline-block;
    margin-top: 16px;
    padding: 10px 18px;
    background: var(--charcoal);
    color: var(--white);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
}

.shop-empty-cta:hover {
    background: var(--royal-yellow);
    color: var(--charcoal);
}

@media (max-width: 1024px) {
    .shop-container {
        padding: 0 24px;
    }

    .shop-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .shop-section {
        padding: 40px 0 30px;
    }

    .shop-title {
        font-size: 1.75rem;
    }

    .shop-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
</style>
@endsection
