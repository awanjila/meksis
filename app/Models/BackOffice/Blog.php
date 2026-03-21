<?php
namespace App\Models\BackOffice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id' );
    }//end of category method

    protected static function boot()
    {
        parent::boot();

        \DB::listen(function ($query) {
            \Log::info($query->sql);
            \Log::info($query->bindings);
            \Log::info($query->time);
        });

        // FIXED: Generate slug on creating (when slug is not already set)
        static::creating(function ($m) {
            if (empty($m->slug)) {
                $m->slug = Str::slug($m->name);
            }
        });

        // FIXED: Add updating event to regenerate slug when name changes
        static::updating(function ($m) {
            if ($m->isDirty('name') && empty($m->slug)) {
                $m->slug = Str::slug($m->name);
            }
        });
    }
}