@extends('client.layout.app')
@section('title')
{{ $product->product_name }} | Meksis Engineering
@endsection

@section('meta_title')
{{ $product->meta_title ?? $product->product_name }} | Meksis Engineering
@endsection

@section('meta_description')
{{ $product->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($product->product_description), 160) }}
@endsection
@section('content')

<section class="pd-section">
    <div class="pd-container">
        <nav class="pd-breadcrumb" aria-label="Breadcrumb">
            <a href="/">Home</a> / <a href="/store">Shop</a> / <a href="{{ route('category.products', $product->category->slug) }}">{{ $product->category->category_name }}</a> / <span>{{ $product->product_name }}</span>
        </nav>

        <div class="pd-main">
            <div class="pd-image">
                <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}">
            </div>

            <div class="pd-info">
                <span class="pd-category">{{ $product->category->category_name }}</span>
                <h1 class="pd-title">{{ $product->product_name }}</h1>
                <p class="pd-price">Ksh {{ $product->selling_price }}</p>

                @if($product->product_features)
                    <div class="pd-features">{!! $product->product_features !!}</div>
                @endif

                @if($product->isOrderable())
                    <add-to-cart :product='@json($product)'></add-to-cart>
                @endif
            </div>
        </div>

        <div class="pd-description">
            <h2 class="pd-heading">DESCRIPTION</h2>
            <div class="pd-body">{!! $product->product_description !!}</div>
        </div>

        @if($products->isNotEmpty())
            <div class="pd-related">
                <h2 class="pd-heading">RELATED PRODUCTS</h2>
                <div class="pd-grid">
                    @foreach($products as $item)
                        <product-card :product='@json($item)'></product-card>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

<faqs-section></faqs-section>

<style>
.pd-section {
    padding: 60px 0 40px;
    background: var(--white);
}

.pd-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 50px;
}

.pd-breadcrumb {
    font-size: 14px;
    color: #666;
    margin-bottom: 32px;
}

.pd-breadcrumb a {
    color: #666;
    text-decoration: none;
}

.pd-breadcrumb a:hover {
    color: var(--charcoal);
}

.pd-breadcrumb span {
    color: var(--charcoal);
    font-weight: 700;
}

.pd-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: start;
    margin-bottom: 60px;
}

.pd-image {
    border: 1px solid #e0e0e0;
    background: #f5f5f5;
    aspect-ratio: 3 / 4;
}

.pd-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pd-info {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.pd-category {
    display: inline-block;
    align-self: flex-start;
    padding: 6px 12px;
    background: var(--royal-yellow);
    color: var(--charcoal);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.pd-title {
    font-size: 2.25rem;
    font-weight: 900;
    color: var(--charcoal);
    text-transform: uppercase;
    line-height: 1.2;
    margin: 0;
}

.pd-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--charcoal);
    margin: 0;
}

.pd-features {
    color: #444;
    line-height: 1.7;
}

.pd-heading {
    font-size: 1.5rem;
    font-weight: 900;
    color: var(--charcoal);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
    padding-left: 12px;
    border-left: 4px solid var(--royal-yellow);
}

.pd-body {
    color: #444;
    line-height: 1.8;
}

.pd-related {
    margin-top: 60px;
}

.pd-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

@media (max-width: 1024px) {
    .pd-container {
        padding: 0 24px;
    }

    .pd-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .pd-section {
        padding: 40px 0 30px;
    }

    .pd-main {
        grid-template-columns: 1fr;
        gap: 28px;
        margin-bottom: 40px;
    }

    .pd-title {
        font-size: 1.6rem;
    }

    .pd-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
