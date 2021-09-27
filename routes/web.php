<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VisitorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', [VisitorController::class, 'index'])->name('home');
Route::get('category/{category:slug}', [VisitorController::class, 'category'])->name('visitor.category');
Route::get('{news:slug}', [VisitorController::class, 'news'])->name('visitor.news');
