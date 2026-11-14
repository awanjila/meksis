@extends('client.layout.app')
@section('title')
Checkout | Meksis Engineering
@endsection

@section('meta_title')
Checkout | Meksis Engineering
@endsection

@section('meta_description')
Enter your details to place your order.
@endsection
@section('content')

<section class="pd-section">
    <div class="pd-container">
        <nav class="pd-breadcrumb" aria-label="Breadcrumb">
            <a href="/">Home</a>
            <span>/</span>
            <a href="/cart">Cart</a>
            <span>/</span>
            <strong>Checkout</strong>
        </nav>

        <h1 class="pd-page-title">Checkout</h1>

        <checkout-page></checkout-page>
    </div>
</section>

@endsection
