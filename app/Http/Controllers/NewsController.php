<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\CategoryService;
use App\Services\NewsImageService;
use App\Services\NewsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(private NewsService $newsService, private CategoryService $categoryService, private NewsImageService $newsImageService)
    {}

    public function index() : View
    {
        $news = News::with('category', 'category.parentCategory', 'author')->orderBy('id', 'desc')->cursorPaginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create() : View
    {
        $categories = $this->categoryService->getUserBasedCategories();
        $categories = $this->categoryService->prependPlaceholder($categories);
        return view('admin.news.create', compact('categories'));
    }

    public function store(NewsRequest $request) : RedirectResponse
    {
        $this->newsService->storeNews($request->validated());
        return redirect()->route('admin.news')->with('success', 'News created successfully!');
    }

    public function edit(News $news) : View
    {
        $categories = $this->categoryService->getUserBasedCategories();
        $categories = $this->categoryService->prependPlaceholder($categories);
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(NewsRequest $request, News $news) : RedirectResponse
    {
        $this->newsService->updateNews($news, $request->validated());
        return redirect()->route('admin.news')->with('success', 'News updated successfully!');
    }

    public function delete(News $news) : RedirectResponse
    {
        $news->delete();
        return redirect()->back()->with('success', 'News deleted successfully!');
    }

    public function updateStatus(News $news, $status) : RedirectResponse
    {
        $this->newsService->updateStatus($news, $status);
        return redirect()->back()->with('success', 'News status updated successfully!');
    }

    public function uploadImage(ImageRequest $request) : JsonResponse
    {
        $images = $this->newsImageService->uploadInsideNewsImage($request->file('image'), $request->input('uuid'));
        return response()->json(['success' => 1, 'file' => $images]);
    }
}
