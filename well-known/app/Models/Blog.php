<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'author',
        'name',
        'slug',
        'description',
        'image'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }



// public function next(){
//     // get next post
//     return blog::where('id', '>', $this->id)->orderBy('id','asc')->first();

// }
// public  function previous(){
//     // get previous  post
//     return blog::where('id', '<', $this->id)->orderBy('id','desc')->first();

// }
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Comment')->with('user');
    }
}
