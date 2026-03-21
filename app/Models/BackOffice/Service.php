<?php

namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

     protected $guarded = [];


      protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            if (!isset($model->slug)) { // Check if the slug is not already set
                $model->slug = Str::slug($model->name); // Generate the slug from the title
            }
//            $model->slug = Str::slug($model->title); // Generate the slug from the title
        });
    }
}
