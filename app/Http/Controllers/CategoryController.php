<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}

    public function create() : View
    {
        $parentCats = $this->categoryService->getParentCategories();
        return view('admin.categories.create', compact('parentCats'));
    }

    public function store(CategoryRequest $request)
    {
        if(Category::create($request->validated())) return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
        return redirect()->route('admin.categories')->with('error', 'Something went wrong! Please try again.');
    }
}
