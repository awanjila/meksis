<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewOrderNotification;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        if ($request->filled('website')) {
            return response()->json([
                'success' => true,
                'reference' => 'MEK-00000000',
                'email' => $request->input('email'),
            ], 201);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'distinct'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $ids = collect($data['items'])->pluck('id')->map(fn ($id) => (int) $id);
        $products = Product::whereIn('id', $ids)->get()->keyBy('id');

        $unavailable = $ids->reject(fn ($id) => $products->get($id)?->isOrderable() ?? false);

        if ($unavailable->isNotEmpty()) {
            $names = $unavailable->map(fn ($id) => $products->get($id)?->product_name ?? 'Product #'.$id);

            throw ValidationException::withMessages([
                'items' => ['Some products are no longer available: '.$names->implode(', ').'.'],
            ]);
        }

        $lines = collect($data['items'])->map(function ($item) use ($products) {
            $product = $products->get((int) $item['id']);
            $quantity = (int) $item['quantity'];
            $unitPrice = round((float) $product->selling_price, 2);

            return [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => round($unitPrice * $quantity, 2),
            ];
        });

        $total = round($lines->sum('subtotal'), 2);

        $order = DB::transaction(function () use ($data, $lines, $total) {
            $order = Order::create([
                'reference' => $this->generateReference(),
                'customer_name' => $data['name'],
                'customer_email' => $data['email'],
                'customer_phone' => $data['phone'],
                'company' => $data['company'] ?? null,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'shipping_address' => $data['address'],
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($lines as $line) {
                $order->items()->create($line);

                $product = Product::whereKey($line['product_id'])->lockForUpdate()->first();
                $stock = is_numeric($product->product_store) ? (float) $product->product_store : 0;

                if ($stock >= $line['quantity']) {
                    $product->decrement('product_store', $line['quantity']);
                }
            }

            return $order;
        });

        $order->load('items.product');

        try {
            Mail::to($order->customer_email)->send(new OrderConfirmation($order));
        } catch (\Throwable $e) {
            Log::error('Order confirmation email failed: '.$e->getMessage(), ['reference' => $order->reference]);
        }

        try {
            Mail::to(config('shop.notification_email'))->send(new NewOrderNotification($order));
        } catch (\Throwable $e) {
            Log::error('New order notification email failed: '.$e->getMessage(), ['reference' => $order->reference]);
        }

        return response()->json([
            'success' => true,
            'reference' => $order->reference,
            'email' => $order->customer_email,
        ], 201);
    }

    private function generateReference(): string
    {
        do {
            $reference = 'MEK-'.Str::upper(Str::random(8));
        } while (Order::where('reference', $reference)->exists());

        return $reference;
    }
}
