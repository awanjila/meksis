@extends('client.layout.app')
@section('title')
Meksis Engineering | Advanced Security Solutions
@endsection

@section('meta_title')
Cart | Meksis Engineering
@endsection

@section('meta_description')
Review the products in your cart before checking out.
@endsection
@section('content')

        <!-- Main content Start -->
        <div class="main-content">

            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs img3">
                <div class="breadcrumbs-inner text-center">
                    <h1 class="page-title">Cart</h1>
                    <ul>
                        <li>
                            <a class="active" href="/">Home</a>
                        </li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumbs End -->

            <!-- Shop part start -->
            <div class="rs-shop-part pt-120 pb-120 md-pt-70 md-pb-80">
                <div class="container">
                    <cart-page></cart-page>
                </div>
            </div>
            <!-- Shop part end -->
        </div>
        <!-- Main content End -->

        <faqs-section></faqs-section>
@endsection
