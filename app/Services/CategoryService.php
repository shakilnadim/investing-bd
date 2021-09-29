<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(private Category $category)
    {}

    public function updateStatus(Category $category, $status) : bool
    {
        if ($status === 'publish') $updatedStatus = true;
        else $updatedStatus = false;
        return $category->update(['is_published' => $updatedStatus]);
    }

    public function getUserBasedCategories() : Collection
    {
        return Category::with('childCategories')->parentCategories()->get();
    }

    public function getPublishedParentCategories() : Collection
    {
        return $this->category->parentCategories()->published()->get();
    }

    public function prependPlaceholder($categories) : Collection
    {
        return add_placeholder_to_collection(
            $categories,
            'Select Parent Category',
            'name'
        );
    }

    public function isPublished(Category $category)
    {
        $isPublished = $category->is_published;
        if ($category->category_id) {
            $isPublished = $category->parentCategory->is_published;
        }
        return $isPublished;
    }
}
