<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

use App\Models\Category;
use App\Models\User;


Route::view('dashboard', 'dashboard')->name('.dashboard');

Route::prefix('news')->name('.news')->group(function (){
    Route::view('', 'admin.news.index');
});

Route::prefix('categories')->name('.categories')->group(function (){
    Route::get('', [CategoryController::class, 'index'])->middleware('can:view-list,' . Category::class);
    Route::middleware('can:create,' . Category::class)->group(function (){
        Route::get('create', [CategoryController::class, 'create'])->name('.create');
        Route::post('store', [CategoryController::class, 'store'])->name('.store');
        Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('.edit');
        Route::patch('{category}/update', [CategoryController::class, 'update'])->name('.update');
        Route::delete('{category}/delete', [CategoryController::class, 'delete'])->name('.delete');
        Route::put('{category}/update/status/{status}', [CategoryController::class, 'updateStatus'])
            ->name('.update.status')
            ->where('status', 'publish|unpublish');
    });
});

Route::prefix('users')->name('.users')->group(function (){
    Route::view('', 'admin.users.index')->middleware('can:view-list,' . User::class);
});
