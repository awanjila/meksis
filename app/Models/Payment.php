<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
        'payment_details',
    ];

    protected $casts = [
        'payment_details' => 'array',
    ];

    /**
     * Get the order for this payment
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}