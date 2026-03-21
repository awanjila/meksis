<?php

namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'description',
        'images',
        'live_url',
        'tech_stack',
        'key_features',
        'featured',
    ];

    protected $casts = [
        'images' => 'array',
        'tech_stack' => 'array',
        'featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
    }
}
