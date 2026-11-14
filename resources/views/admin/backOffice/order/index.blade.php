@extends('admin.admin_master')

@section('title')
  Orders
@endsection

@section('content')

<div class="content">
  <!-- Start Content-->
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">
          <h4 class="page-title">Orders</h4>
        </div>
      </div>
    </div>
    <!-- end page title -->

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
              <thead>
                <tr>
                  <th>Reference</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Payment</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($orders as $order)
                  <tr>
                    <td>{{ $order->reference }}</td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ ucfirst($order->payment_status) }}</td>
                    <td>
                      <a href="{{ route('orders.show', $order) }}" class="btn btn-blue rounded-pill waves-effect waves-light">View</a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9" class="text-center">No orders yet</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            <div class="mt-3">
              {{ $orders->links() }}
            </div>
          </div> <!-- end card body-->
        </div> <!-- end card -->
      </div><!-- end col-->
    </div>
    <!-- end row-->

  </div> <!-- container -->
</div> <!-- content -->

@endsection
