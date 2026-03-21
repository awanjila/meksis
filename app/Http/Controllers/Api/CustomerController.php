<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Check if the customer is authenticated
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth(Request $request)
    {
        $isAuthenticated = Auth::guard('customer')->check();
        $customer = null;

        if ($isAuthenticated) {
            $customer = Auth::guard('customer')->user();
            $customer = [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
            ];
        }

        return response()->json([
            'authenticated' => $isAuthenticated,
            'customer' => $customer,
        ]);
    }
} 