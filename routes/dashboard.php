<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;

use App\Models\Category;
use App\Models\User;
use App\Models\News;


Route::view('dashboard', 'dashboard')->name('.dashboard');

Route::prefix('news')->name('.news')->group(function (){
    Route::get('', [NewsController::class, 'index'])->middleware('can:view-list,' . News::class);
    Route::middleware('can:create,' . News::class)->group(function (){
        Route::get('create', [NewsController::class, 'create'])->name('.create');
        Route::post('store', [NewsController::class, 'store'])->name('.store');
    });
    Route::post('image/upload', [NewsController::class, 'uploadImage'])->name('.uploadImage');
});

Route::prefix('categories')->name('.categories')->group(function (){
    Route::get('', [CategoryController::class, 'index'])->middleware('can:view-list,' . Category::class);
    Route::middleware('can:create,' . Category::class)->group(function (){
        Route::get('create', [CategoryController::class, 'create'])->name('.create');
        Route::post('store', [CategoryController::class, 'store'])->name('.store');
    });

    Route::middleware('can:update,category')->group(function (){
        Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('.edit');
        Route::patch('{category}/update', [CategoryController::class, 'update'])->name('.update');
        Route::put('{category}/update/status/{status}', [CategoryController::class, 'updateStatus'])
            ->name('.update.status')
            ->where('status', 'publish|unpublish');
    });

    Route::delete('{category}/delete', [CategoryController::class, 'delete'])->name('.delete')->middleware('can:delete,category');

});

Route::prefix('users')->name('.users')->group(function (){
    Route::view('', 'admin.users.index')->middleware('can:view-list,' . User::class);
});
