@extends('client.layout.app')
@section('title')
Meksis Engineering | Advanced Security Solutions
@endsection

@section('meta_title')
Checkout | Meksis Engineering
@endsection

@section('meta_description')
Enter your details to place your order.
@endsection
@section('content')

        <!-- Main content Start -->
        <div class="main-content">

            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs img3">
                <div class="breadcrumbs-inner text-center">
                    <h1 class="page-title">Checkout</h1>
                    <ul>
                        <li>
                            <a class="active" href="/">Home</a>
                        </li>
                        <li>
                            <a href="/cart">Cart</a>
                        </li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumbs End -->

            <!-- Shop part start -->
            <div class="rs-shop-part pt-120 pb-120 md-pt-70 md-pb-80">
                <div class="container">
                    <checkout-page></checkout-page>
                </div>
            </div>
            <!-- Shop part end -->
        </div>
        <!-- Main content End -->
@endsection
