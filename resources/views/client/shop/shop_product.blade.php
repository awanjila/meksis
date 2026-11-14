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
            <a href="/">Home</a>
            <span>/</span>
            <a href="/store">Shop</a>
            <span>/</span>
            <a href="{{ route('category.products', $product->category->slug) }}">{{ $product->category->category_name }}</a>
            <span>/</span>
            <strong>{{ $product->product_name }}</strong>
        </nav>

        <div class="pd-main">
            <div class="pd-image">
                <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}">
            </div>

            <div class="pd-info">
                <p class="pd-category">{{ $product->category->category_name }}</p>
                <h1 class="pd-title">{{ $product->product_name }}</h1>

                @if($product->isOrderable())
                    <p class="pd-availability">Available to order</p>
                @endif

                <p class="pd-price">Ksh {{ $product->selling_price }}</p>

                @if($product->isOrderable())
                    <add-to-cart :product='@json($product)'></add-to-cart>
                @endif

                <a class="pd-whatsapp" target="_blank" rel="noopener"
                   href="https://wa.me/254735551515?text={{ urlencode("Hi Meksis, I'm interested in " . $product->product_name) }}">
                    Ask on WhatsApp
                </a>

                @if($product->product_features)
                    <div class="pd-features">
                        <h2 class="pd-heading">Key features</h2>
                        <div class="pd-body">{!! $product->product_features !!}</div>
                    </div>
                @endif
            </div>
        </div>

        <div class="pd-block">
            <h2 class="pd-heading">Description</h2>
            <div class="pd-body">{!! $product->product_description !!}</div>
        </div>

        @if($products->isNotEmpty())
            <div class="pd-block">
                <h2 class="pd-heading">Related products</h2>
                <div class="pd-grid">
                    @foreach($products as $item)
                        <product-card :product='@json($item)'></product-card>
                    @endforeach
                </div>
            </div>
        @endif

        <shop-trust-bar></shop-trust-bar>
    </div>
</section>

<faqs-section></faqs-section>

<style>
.pd-section {
    padding: 48px 0 40px;
    background: var(--white);
}

.pd-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 50px;
}

.pd-breadcrumb {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #888;
    margin-bottom: 28px;
}

.pd-breadcrumb a {
    color: #888;
    text-decoration: none;
}

.pd-breadcrumb a:hover {
    color: var(--charcoal);
}

.pd-breadcrumb strong {
    color: var(--charcoal);
    font-weight: 700;
}

.pd-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 56px;
    align-items: start;
    margin-bottom: 64px;
}

.pd-image {
    background: #f4f4f4;
    border: 1px solid #e5e5e5;
    aspect-ratio: 1 / 1;
    overflow: hidden;
}

.pd-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.pd-info {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.pd-category {
    align-self: flex-start;
    padding: 5px 10px;
    background: var(--royal-yellow);
    color: var(--charcoal);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin: 0;
}

.pd-title {
    font-size: 2rem;
    font-weight: 900;
    color: var(--charcoal);
    text-transform: uppercase;
    line-height: 1.15;
    margin: 0;
}

.pd-availability {
    font-size: 12px;
    font-weight: 700;
    color: #1f8a4c;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0;
}

.pd-price {
    font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--charcoal);
    margin: 4px 0 0;
    padding-bottom: 14px;
    border-bottom: 1px solid #ededed;
}

.pd-whatsapp {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    align-self: flex-start;
    padding: 10px 18px;
    border: 1px solid var(--charcoal);
    color: var(--charcoal);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
}

.pd-whatsapp:hover {
    background: var(--charcoal);
    color: var(--white);
}

.pd-features {
    margin-top: 12px;
}

.pd-block {
    margin-bottom: 64px;
}

.pd-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.1rem;
    font-weight: 900;
    color: var(--charcoal);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0 0 18px;
}

.pd-heading::before {
    content: '';
    width: 8px;
    height: 20px;
    background: var(--royal-yellow);
}

.pd-body {
    color: #444;
    line-height: 1.8;
    font-size: 0.95rem;
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
        padding: 32px 0 24px;
    }

    .pd-main {
        grid-template-columns: 1fr;
        gap: 28px;
        margin-bottom: 44px;
    }

    .pd-title {
        font-size: 1.5rem;
    }

    .pd-block {
        margin-bottom: 44px;
    }

    .pd-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
