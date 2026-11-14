@extends('client.layout.app')
@section('title')
Meksis Engineering | Advanced Security Solutions
@endsection

@section('meta_title')
Order {{ $order->reference }} | Meksis Engineering
@endsection

@section('meta_description')
Your order has been received.
@endsection
@section('content')

        <!-- Main content Start -->
        <div class="main-content">

            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs img3">
                <div class="breadcrumbs-inner text-center">
                    <h1 class="page-title">Order Confirmation</h1>
                    <ul>
                        <li>
                            <a class="active" href="/">Home</a>
                        </li>
                        <li>Order Confirmation</li>
                    </ul>
                </div>
            </div>
            <!-- Breadcrumbs End -->

            <!-- Shop part start -->
            <div class="rs-shop-part pt-120 pb-120 md-pt-70 md-pb-80">
                <div class="container">
                    <div class="order-confirmation">
                        <h2 class="order-title">Thank you for your order</h2>
                        <p class="order-message">Order received. We'll confirm availability and payment with you by email.</p>

                        <div class="order-details">
                            <div class="order-detail">
                                <span class="detail-label">Order Reference</span>
                                <strong>{{ $order->reference }}</strong>
                            </div>
                            <div class="order-detail">
                                <span class="detail-label">Name</span>
                                <strong>{{ $order->customer_name }}</strong>
                            </div>
                            <div class="order-detail">
                                <span class="detail-label">Email</span>
                                <strong>{{ $order->customer_email }}</strong>
                            </div>
                            <div class="order-detail">
                                <span class="detail-label">Delivery Address</span>
                                <strong>{{ $order->shipping_address }}</strong>
                            </div>
                        </div>

                        <div class="order-table">
                            <div class="order-row order-head">
                                <span>Product</span>
                                <span>Price</span>
                                <span>Quantity</span>
                                <span>Total</span>
                            </div>

                            @foreach ($order->items as $item)
                                <div class="order-row order-item">
                                    <span class="order-product-name">{{ $item->product?->product_name ?? 'Product' }}</span>
                                    <span>Ksh {{ $item->unit_price }}</span>
                                    <span>{{ $item->quantity }}</span>
                                    <span>Ksh {{ $item->subtotal }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="order-total">
                            <span>Total</span>
                            <strong>Ksh {{ $order->total_amount }}</strong>
                        </div>

                        <a href="/store" class="btn-store">Continue Shopping</a>
                    </div>
                </div>
            </div>
            <!-- Shop part end -->
        </div>
        <!-- Main content End -->

<style>
    .order-confirmation {
        max-width: 900px;
        margin: 0 auto;
        font-family: 'Arial Narrow', sans-serif;
        color: var(--charcoal);
    }

    .order-confirmation * {
        border-radius: 0 !important;
    }

    .order-title {
        font-size: 28px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .order-message {
        margin-bottom: 30px;
    }

    .order-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        border: 1px solid #e5e5e5;
        padding: 20px;
        margin-bottom: 30px;
    }

    .detail-label {
        display: block;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .order-table {
        border: 1px solid #e5e5e5;
    }

    .order-row {
        display: grid;
        grid-template-columns: 3fr 1.2fr 1fr 1.2fr;
        gap: 16px;
        align-items: center;
        padding: 16px 20px;
    }

    .order-head {
        background: var(--charcoal);
        color: var(--white);
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .order-item + .order-item {
        border-top: 1px solid #e5e5e5;
    }

    .order-product-name {
        font-weight: 700;
        text-transform: uppercase;
    }

    .order-total {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 24px;
        margin-top: 20px;
        font-size: 18px;
        text-transform: uppercase;
    }

    .btn-store {
        display: inline-block;
        margin-top: 30px;
        padding: 14px 28px;
        background: var(--royal-yellow);
        border: 1px solid var(--royal-yellow);
        color: var(--charcoal);
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.2s;
    }

    .btn-store:hover {
        background: transparent;
        color: var(--royal-yellow);
    }

    @media (max-width: 768px) {
        .order-details {
            grid-template-columns: 1fr;
        }

        .order-head {
            display: none;
        }

        .order-row {
            grid-template-columns: 1fr 1fr;
        }

        .order-product-name {
            grid-column: 1 / -1;
        }
    }
</style>
@endsection
