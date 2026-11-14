@extends('admin.admin_master')

@section('title')
  Order {{ $order->reference }}
@endsection

@section('content')

<div class="content">
  <!-- Start Content-->
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <div class="page-title-right">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary rounded-pill waves-effect waves-light">Back to Orders</a>
          </div>
          <h4 class="page-title">Order {{ $order->reference }}</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="mb-3">Customer</h5>
            <p class="mb-1"><strong>Name:</strong> {{ $order->customer_name }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p class="mb-1"><strong>Phone:</strong> {{ $order->customer_phone }}</p>
            @if($order->company)
              <p class="mb-1"><strong>Company:</strong> {{ $order->company }}</p>
            @endif
            <p class="mb-1"><strong>Delivery address:</strong> {{ $order->shipping_address }}</p>
            @if($order->billing_address)
              <p class="mb-1"><strong>Billing address:</strong> {{ $order->billing_address }}</p>
            @endif
            @if($order->notes)
              <p class="mb-1"><strong>Notes:</strong> {{ $order->notes }}</p>
            @endif
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="mb-3">Update Status</h5>
            <form method="post" action="{{ route('orders.status', $order) }}">
              @csrf
              <div class="mb-3">
                <label for="status" class="form-label">Order Status</label>
                <select name="status" id="status" class="form-control">
                  @foreach(['pending', 'confirmed', 'paid', 'delivered', 'cancelled'] as $status)
                    <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                  @endforeach
                </select>
                @error('status')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-control">
                  @foreach(['pending', 'paid'] as $paymentStatus)
                    <option value="{{ $paymentStatus }}" @selected($order->payment_status === $paymentStatus)>{{ ucfirst($paymentStatus) }}</option>
                  @endforeach
                </select>
                @error('payment_status')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <button class="btn btn-primary" type="submit">Save Status</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="mb-3">Items</h5>
            <table class="table table-centered w-100 dt-responsive nowrap">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order->items as $item)
                  <tr>
                    <td>{{ $item->product->product_name ?? 'Deleted product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->subtotal, 2) }}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="3" class="text-end">Total</th>
                  <th>{{ number_format($order->total_amount, 2) }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div> <!-- container -->
</div> <!-- content -->

@endsection
