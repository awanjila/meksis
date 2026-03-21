<?php

namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PortfolioCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class, 'category_id');
    }
}
