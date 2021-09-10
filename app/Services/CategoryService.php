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

    public function getUserBasedPublishedCategories() : Collection
    {
        return Category::with('publishedChildCategories')->published()->whereNull('category_id')->get();
    }

    public function prependPlaceholder($categories) : Collection
    {
        return add_placeholder_to_collection(
            $categories,
            'Select Parent Category',
            'name'
        );
    }
}
