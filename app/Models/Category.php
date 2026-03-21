<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $table = 'categories';
    protected $guarded = [];


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


    public function getRouteKeyName(){
        return 'slug';
    }

// Define a relationship to get the parent category.
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Define a relationship to get the children categories.
    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    

}
