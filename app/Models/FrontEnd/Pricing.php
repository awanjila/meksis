<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $guarded = [];

     // Define the inverse relationship
     public function pricingPackage()
     {
         return $this->belongsTo(PricingPackage::class, 'pricing_package_id', 'id');
     }
}


