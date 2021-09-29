<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorController extends Controller
{
    public function __construct(private CategoryService $categoryService)
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

    public function news(News $news)
    {
        return $news;
    }
}
