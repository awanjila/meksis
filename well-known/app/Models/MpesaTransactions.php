<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaTransactions extends Model
{
    use HasFactory;

    protected $fillable =[
        'result_desc',
        'result_code',
        'merchant_request_id',
        'checkout_request_id',
        'amount',
        'mpesa_receipt_number',
        'b2c_utility_account_available_funds',
        'transaction_date',
        'phone_number'


    ];

    protected $table ='mpesa_transactions';

}
