@component('mail::message')
# New order {{ $order->reference }}

**Customer:** {{ $order->customer_name }}<br>
**Email:** {{ $order->customer_email }}<br>
**Phone:** {{ $order->customer_phone }}<br>
**Company:** {{ $order->company ?? '-' }}

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

@component('mail::button', ['url' => 'mailto:'.$order->customer_email])
Reply to {{ $order->customer_name }}
@endcomponent
@endcomponent
