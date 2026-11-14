@component('mail::message')
# Thank you for your order

Your order reference is **{{ $order->reference }}**.

| Item | Qty | Unit price | Subtotal |
|:-----|:---:|-----------:|---------:|
@foreach ($order->items as $item)
| {{ $item->product->product_name ?? 'Product' }} | {{ $item->quantity }} | {{ number_format($item->unit_price, 2) }} | {{ number_format($item->subtotal, 2) }} |
@endforeach

**Total: {{ number_format($order->total_amount, 2) }}**

**Delivery address:** {{ $order->shipping_address }}

@if ($order->notes)
**Notes:** {{ $order->notes }}
@endif

Our team will contact you to confirm availability and payment arrangements.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
