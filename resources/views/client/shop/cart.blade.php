@extends('client.layout.app')
@section('title')
Cart | Meksis Engineering
@endsection

@section('meta_title')
Cart | Meksis Engineering
@endsection

@section('meta_description')
Review the products in your cart before checking out.
@endsection
@section('content')

<section class="pd-section">
    <div class="pd-container">
        <nav class="pd-breadcrumb" aria-label="Breadcrumb">
            <a href="/">Home</a>
            <span>/</span>
            <a href="/store">Shop</a>
            <span>/</span>
            <strong>Cart</strong>
        </nav>

        <h1 class="pd-page-title">Your Cart</h1>

        <cart-page></cart-page>
    </div>
</section>

@endsection
