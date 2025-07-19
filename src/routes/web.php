<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('products')->name('products.')->group(function () {
    // 商品一覧（GET /products）
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // 商品検索（GET /products/search）
    Route::get('/search', [ProductController::class, 'search'])->name('search');

    // 商品登録（フォーム表示＋登録処理）
    Route::get('/register', [ProductController::class, 'create'])->name('create');  // フォーム
    Route::post('/register', [ProductController::class, 'store'])->name('store');   // 登録処理

    // 商品詳細（GET /products/{product}）
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');

    // 商品編集（GET /products/{product}/edit）
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');

    // 商品更新（POST /products/{product}/update）
    Route::post('/{product}/update', [ProductController::class, 'update'])->name('update');

    // 商品削除（POST /products/{product}/delete）
    Route::post('/{product}/delete', [ProductController::class, 'destroy'])->name('destroy');
});