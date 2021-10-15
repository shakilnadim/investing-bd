<?php

namespace App\View\Components\Visitor;

use App\Services\CategoryService;
use App\Services\NewsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class HomeCategoriesNews extends Component
{
    public Collection $homeCategories;

    public function __construct(private CategoryService $categoryService, private NewsService $newsService)
    {
        $this->homeCategories = $this->categoryService->getPublishedHomeCategories();
        $this->fetchCategoryNews();
    }

    private function fetchCategoryNews() : void
    {
        foreach ($this->homeCategories as $category){
            $category->news = $this->newsService->getLimitedLatestPublishedCategoryNews($this->makeArrayList($category), 3);
        }
    }

    private function makeArrayList($category) : array
    {
        $categories = [$category->id];
        foreach ($category->publishedChildCategories as $childCategory) {
            $categories[] = $childCategory->id;
        }

        return $categories;
    }

    public function render() : View
    {
        return view('components.visitor.home-categories-news');
    }
}
