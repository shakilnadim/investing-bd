<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(private Category $category)
    {}

    public function getParentCategories() : array
    {
        $parentCats = $this->category->whereNull('category_id')->get();
        return format_key_values($parentCats, 'name', 'id', 'Select parent category');
    }
}
