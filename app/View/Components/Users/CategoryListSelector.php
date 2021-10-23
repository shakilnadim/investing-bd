<?php

namespace App\View\Components\Users;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CategoryListSelector extends Component
{

    public function __construct()
    {
        //
    }

    public function getParentCategories() : Collection
    {
        return Category::select('id', 'name')->parentCategories()->orderBy('name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.users.category-list-selector');
    }
}
