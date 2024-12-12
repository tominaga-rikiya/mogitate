<?php


use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
//画面一覧
Route::get('products', [ProductController::class, 'index'])->name('products.index');

// 商品登録
Route::get('/products/register', [ProductController::class, 'register'])->name('products.register');
Route::post('/products/register', [ProductController::class, 'store'])->name('products.store');

//詳細画面
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show');

// 商品更新
Route::get('/products/{productId}/update', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// 商品検索
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// 商品削除
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
