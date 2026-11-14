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

        <!-- Main content Start -->
        <div class="main-content">

            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs img3">
                <div class="breadcrumbs-inner text-center">
                    <h1 class="page-title">Shop</h1>
                    <ul>
                        <li>
                            <a class="active" href="/">Home</a>
                        </li>
                        <li>Shop</li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumbs End -->

            <!-- Shop part start -->
            <div class="rs-shop-part pt-120 pb-120 md-pt-70 md-pb-80">
                <div class="container">
                    <div class="row mb-50">
                        <div class="col-12 text-center">
                            <a href="/store">Shop all</a>
                            @foreach($categories as $category)
                                | <a href="{{ route('category.products', $category->slug) }}">{{ $category->category_name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        @forelse($products as $product)
                            <product-card :product='@json($product)'></product-card>
                        @empty
                            <div class="col-12 text-center">
                                <p>No products are available yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- Shop part end -->
        </div>
        <!-- Main content End -->

        <faqs-section></faqs-section>
@endsection
