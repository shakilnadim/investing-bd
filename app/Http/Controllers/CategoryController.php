<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}

    public function index() : View
    {
        $categories = Category::orderBy('name')->simplePaginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create() : View
    {
        $parentCats = $this->categoryService->getParentCategories();
        return view('admin.categories.create', compact('parentCats'));
    }

    public function store(CategoryRequest $request) : RedirectResponse
    {
        if(Category::create($request->validated())) return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
        return redirect()->route('admin.categories')->with('error', 'Something went wrong! Please try again.');
    }

    public function edit(Category $category) : View
    {
        $parentCats = $this->categoryService->getParentCategories();
        return view('admin.categories.edit', ['category' => $category, 'parentCats' => $parentCats]);
    }

    public function update(CategoryRequest $request, Category $category) : RedirectResponse
    {
        if ($category->update($request->validated())) return redirect()->back()->with('success', 'Category updated successfully!');
        return redirect()->back()->with('error', 'Something went wrong! Please try again.');
    }

    public function delete(Category $category)
    {
        return $category;
    }
}
