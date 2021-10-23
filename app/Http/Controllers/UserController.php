<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index() : View
    {
        $users = User::orderBy('name')->simplePaginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create() : View
    {
        $parentCategories = Category::select('id', 'name')->parentCategories()->orderBy('name')->get();
        return view('admin.users.create', compact('parentCategories'));
    }

    public function store()
    {}

    public function edit(User $user) : View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update()
    {}

    public function delete()
    {}
}
