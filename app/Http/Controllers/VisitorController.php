<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorController extends Controller
{
    public function __construct()
    {
    }

    public function index() : View
    {
        return view('visitor.index');
    }

    public function category(Category $category) : View
    {
        return view('visitor.category', compact('category'));
    }

    public function news(News $news)
    {
        return $news;
    }
}
