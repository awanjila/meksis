<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [

        'name',
        'slug',
        'description',
        'product_image'
    ];
    use HasFactory;

    public  function product_images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }
}
