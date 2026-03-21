<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    private $clientId;
    private $clientSecret;
    private $baseUrl;

    public function __construct()
    {
        // Use the PayPal mode from config
        $this->baseUrl = config('services.paypal.mode') === 'live' 
            ? 'https://api-m.paypal.com' 
            : 'https://api-m.sandbox.paypal.com';
            
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
    }//endmethod

    /**
     * Get PayPal access token
     */
    private function getAccessToken()
    {
        $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
            ->asForm()
            ->post("{$this->baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials'
            ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        Log::error('PayPal Access Token Error', ['response' => $response->json()]);
        throw new \Exception('Could not get PayPal access token');
    }//endmethod

    /**
     * Create a PayPal order
     */
    public function createOrder(Request $request)
    {
        try {
            $token = $this->getAccessToken();
            
            // Get cart items and total from request
            $items = $request->items;
            $total = $request->total;
            
            // Convert KES to USD (you'll need to implement currency conversion)
            // This is a simplified example - use a proper conversion service in production
            $usdTotal = $this->convertToUSD($total);
            
            $payload = [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => number_format($usdTotal, 2, '.', ''),
                        ],
                        'description' => 'Purchase from Your Store Name',
                    ]
                ],
                'application_context' => [
                    'return_url' => route('paypal.success'),
                    'cancel_url' => route('paypal.cancel'),
                ]
            ];

            $response = Http::withToken($token)
                ->post("{$this->baseUrl}/v2/checkout/orders", $payload);

            if ($response->successful()) {
                $orderId = $response->json()['id'];
                
                // Store order details in database
                $order = Order::create([
                    'payment_method' => 'paypal',
                    'payment_id' => $orderId,
                    'total_amount' => $total, // Original amount in KES
                    'status' => 'pending',
                    'items' => json_encode($items),
                    'customer_id' => auth('customer')->id(), // Use customer_id instead of user_id
                    // Add other necessary fields
                ]);

                return response()->json([
                    'success' => true,
                    'orderId' => $orderId,
                ]);
            }
            
            Log::error('PayPal Create Order Error', ['response' => $response->json()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create PayPal order'
            ], 500);

        } catch (\Exception $e) {
            Log::error('PayPal Create Order Exception', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request'
            ], 500);
        }
    }//endmethod

    /**
     * Capture a PayPal order payment
     */
    public function captureOrder(Request $request)
    {
        try {
            $orderId = $request->orderId;
            $token = $this->getAccessToken();

            $response = Http::withToken($token)
                ->post("{$this->baseUrl}/v2/checkout/orders/{$orderId}/capture");

            if ($response->successful()) {
                $paymentData = $response->json();
                
                // Update order status in database
                $order = Order::where('payment_id', $orderId)->first();
                if ($order) {
                    $order->status = 'completed';
                    $order->save();
                    
                    // Create payment record
                    Payment::create([
                        'order_id' => $order->id,
                        'payment_method' => 'paypal',
                        'transaction_id' => $paymentData['id'],
                        'amount' => $order->total_amount,
                        'status' => 'completed',
                        'payment_details' => json_encode($paymentData),
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'data' => $paymentData
                ]);
            }
            
            Log::error('PayPal Capture Order Error', ['response' => $response->json()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to capture PayPal payment'
            ], 500);

        } catch (\Exception $e) {
            Log::error('PayPal Capture Order Exception', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your payment'
            ], 500);
        }
    }//endmethod

    /**
     * Convert KES to USD
     * In production, use a proper currency conversion API
     */
    private function convertToUSD($kesAmount)
    {
        // This is just a placeholder - you should use a real currency conversion service
        // Example conversion rate: 1 USD = 130 KES (this will vary)
        $conversionRate = 130;
        return $kesAmount / $conversionRate;
    }//endmethod

    /**
     * Handle successful payment redirect
     */
    public function success()
    {
        return view('payment.success');
    }//endmethod

    /**
     * Handle cancelled payment redirect
     */
    public function cancel()
    {
        return view('payment.cancel');
    }//endmethod
}