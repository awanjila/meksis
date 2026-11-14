<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::latest()->paginate(20);
        return view('admin.backOffice.order.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load('items.product');
        return view('admin.backOffice.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,paid,delivered,cancelled'],
            'payment_status' => ['required', 'in:pending,paid'],
        ]);

        $order->update($data);

        return redirect()->back()->with([
            'message' => 'Order updated successfully',
            'alert-type' => 'success',
        ]);
    }
}
