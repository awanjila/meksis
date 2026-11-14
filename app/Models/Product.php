<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['image_url', 'is_orderable'];

    public function isOrderable(): bool
    {
        return is_numeric($this->selling_price) && (float) $this->selling_price > 0;
    }

    public function getImageUrlAttribute(): string
    {
        return $this->product_image ? asset($this->product_image) : '';
    }

    public function getIsOrderableAttribute(): bool
    {
        return $this->isOrderable();
    }

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
