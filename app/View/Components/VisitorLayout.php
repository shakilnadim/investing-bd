<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VisitorLayout extends Component
{
    public function __construct(public $category = null, public $news = null)
    {
        if ($this->news) $this->category = $this->news->category;
    }

    public function showSubNav() : bool
    {
        return ($this->category !== null && ($this->category->category_id !== null || $this->getSiblingOrSubCategories()->count() > 0));
    }

    public function getSiblingOrSubCategories()
    {
        if ($this->category->category_id === null) return $this->category->publishedChildCategories;
        return $this->category->parentCategory->publishedChildCategories;
    }

    public function render()
    {
        return view('layouts.visitor');
    }
}
