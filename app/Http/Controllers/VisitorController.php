<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryNewsCollection;
use App\Models\Category;
use App\Models\News;
use App\Services\CategoryService;
use App\Services\NewsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorController extends Controller
{
    public function __construct(private CategoryService $categoryService, private NewsService $newsService)
    {
    }

    public function index() : View
    {
        return view('visitor.index');
    }

    public function category(Category $category) : View
    {
        if (!$this->categoryService->isPublished($category)) abort(404);
        return view('visitor.category', compact('category'));
    }

    public function categoryNews(Category $category) : CategoryNewsCollection
    {
        if (!$this->categoryService->isPublished($category)) response()->json(['status' => 404, 'message' => 'Category not found']);
        $news = $this->newsService->getPaginatedLatestPublishedCategoryNews($category);
        return new CategoryNewsCollection($news);
    }

    public function news(News $news) : View
    {
        if (!$this->newsService->isFullyPublished($news)) abort(404);
        return view('visitor.news', compact('news'));
    }
}
