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


@endsection
