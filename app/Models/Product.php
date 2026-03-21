<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // public function supplier(){
    //     return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    // }

    public function images(){
    return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
