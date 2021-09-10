<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function parentCategory() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function childCategories() : HasMany
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function publishedChildCategories() : HasMany
    {
        return $this->hasMany(Category::class, 'category_id')->published();
    }

    public function scopePublished($q)
    {
        $q->where('is_published', true);
    }

    public function scopeParentCategories($q)
    {
        $q->where('category_id', null);
    }
}
