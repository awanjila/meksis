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
use RuntimeException;

class OrderController extends Controller
{
    private const REFERENCE_ATTEMPTS = 5;

    public function store(Request $request): JsonResponse
    {
        if ($request->filled('hp_field')) {
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

        $order = DB::transaction(function () use ($data) {
            $lines = collect($data['items'])->sortBy('id')->map(function ($item) {
                $product = Product::whereKey((int) $item['id'])->lockForUpdate()->first();

                if (! $product || ! $product->isOrderable()) {
                    throw ValidationException::withMessages([
                        'items' => ['Some products are no longer available. Remove them from your cart and try again.'],
                    ]);
                }

                $quantity = (int) $item['quantity'];
                $unitPrice = round((float) $product->selling_price, 2);

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => round($unitPrice * $quantity, 2),
                ];
            });

            $order = Order::create([
                'reference' => $this->generateReference(),
                'customer_name' => $data['name'],
                'customer_email' => $data['email'],
                'customer_phone' => $data['phone'],
                'company' => $data['company'] ?? null,
                'total_amount' => round($lines->sum('subtotal'), 2),
                'status' => 'pending',
                'payment_status' => 'pending',
                'shipping_address' => $data['address'],
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($lines as $line) {
                $order->items()->create([
                    'product_id' => $line['product']->id,
                    'quantity' => $line['quantity'],
                    'unit_price' => $line['unit_price'],
                    'subtotal' => $line['subtotal'],
                ]);

                $stock = is_numeric($line['product']->product_store) ? (float) $line['product']->product_store : 0;

                if ($stock >= $line['quantity']) {
                    $line['product']->decrement('product_store', $line['quantity']);
                }
            }

            return $order;
        });

        $order->load('items.product');

        try {
            Mail::to($order->customer_email)->send(new OrderConfirmation($order));
        } catch (\Throwable $e) {
            Log::error('Order confirmation email failed: '.$e::class, ['reference' => $order->reference]);
        }

        try {
            Mail::to(config('shop.notification_email'))->send(new NewOrderNotification($order));
        } catch (\Throwable $e) {
            Log::error('New order notification email failed: '.$e::class, ['reference' => $order->reference]);
        }

        return response()->json([
            'success' => true,
            'reference' => $order->reference,
            'email' => $order->customer_email,
        ], 201);
    }

    private function generateReference(): string
    {
        for ($attempt = 0; $attempt < self::REFERENCE_ATTEMPTS; $attempt++) {
            $reference = 'MEK-'.Str::upper(Str::random(8));

            if (! Order::where('reference', $reference)->exists()) {
                return $reference;
            }
        }

        throw new RuntimeException('Could not generate a unique order reference.');
    }
}
