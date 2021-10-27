<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function index() : View
    {
        $users = User::orderBy('name')->simplePaginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create() : View
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request) : RedirectResponse
    {
        $this->userService->createUser($request->validated());
        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    public function edit(User $user) : View
    {
        $permittedCategories = $this->userService->formatPermittedCategoriesForUi($user->categories);
        return view('admin.users.edit', compact('user', 'permittedCategories'));
    }

    public function update(User $user, UserRequest $request) : RedirectResponse
    {
        $this->userService->updateUser($user, $request->validated());
        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function delete(User $user) : RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}
