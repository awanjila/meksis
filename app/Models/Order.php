<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_amount',
        'status',
        'payment_status',
        'shipping_address',
        'billing_address',
        'notes',
    ];

    /**
     * Get the payment for this order
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    
    /**
     * Get the customer who placed this order
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}//endclass