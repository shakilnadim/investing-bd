<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::view('dashboard', 'dashboard')->name('.dashboard');

Route::prefix('news')->name('.news')->group(function (){
    Route::view('', 'admin.news.index');
});

Route::prefix('categories')->name('.categories')->group(function (){
    Route::view('', 'admin.categories.index')->middleware('can:view-list,' . \App\Models\Category::class);
    Route::middleware('can:create,' . \App\Models\Category::class)->group(function (){
        Route::get('create', [CategoryController::class, 'create'])->name('.create');
        Route::post('store', [CategoryController::class, 'store'])->name('.store');
    });
});

Route::prefix('users')->name('.users')->group(function (){
    Route::view('', 'admin.users.index')->middleware('can:view-list,' . \App\Models\User::class);
});
