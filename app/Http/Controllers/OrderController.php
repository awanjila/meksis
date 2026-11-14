<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function show(string $reference): View
    {
        $order = Order::with('items.product')
            ->where('reference', $reference)
            ->firstOrFail();

        return view('client.shop.order_confirmation', compact('order'));
    }
}
