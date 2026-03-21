<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define the relationship
    public function pricings()
    {
        return $this->hasMany(Pricing::class);
    }
}
