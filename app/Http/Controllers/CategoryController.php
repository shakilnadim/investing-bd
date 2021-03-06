<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService){}

    public function index() : View
    {
        $categories = Category::with('parentCategory')->orderBy('name')->simplePaginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCats = Category::parentCategories()->get();
        $parentCats = $this->categoryService->prependPlaceholder($parentCats);
        return view('admin.categories.create', compact('parentCats'));
    }

    public function store(CategoryRequest $request) : RedirectResponse
    {
        Category::create($request->validated());
        return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category) : View
    {
        $parentCats = Category::parentCategories()->published()->where('id', '!=', $category->id)->get();
        $parentCats = $this->categoryService->prependPlaceholder($parentCats);
        return view('admin.categories.edit', ['category' => $category, 'parentCats' => $parentCats]);
    }

    public function update(CategoryRequest $request, Category $category) : RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }

    public function delete(Category $category) : RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }

    public function updateStatus(Category $category, $status) : RedirectResponse
    {
        $this->categoryService->updateStatus($category, $status);
        return redirect()->back()->with('success', 'Category status updated successfully!');
    }
}
