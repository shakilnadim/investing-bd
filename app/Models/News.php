<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($q)
    {
        $q->with('category', 'category.parentCategory')
            ->where('is_published', true)
            ->whereHas('category', function ($q) {
                $q->published();
            })
            ->where(function ($q){
                $q->whereHas('category.parentCategory', function ($q){
                    $q->published();
                })
                    ->orDoesntHave('category.parentCategory');
            });
    }

    public function scopeFeatured($q)
    {
        $q->where('is_featured', true);
    }

    public function scopeBetweenStartEndDate($q)
    {
        $q->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now());
    }
}
