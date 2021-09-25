<?php

namespace App\View\Components\Inc;

use App\Services\CategoryService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class VisitorNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(private CategoryService $categoryService)
    {
    }

    public function navItems() : Collection
    {
        return $this->categoryService->getPublishedParentCategories();
    }

    public function render() : View
    {
        return view('components.inc.visitor-nav');
    }
}
