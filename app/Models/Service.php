<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'meta_title',
        'meta_description',
        'slug',
        'description',
        'cover_image'
    ];
}
