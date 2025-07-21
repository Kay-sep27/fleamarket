<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('products')->name('products.')->group(function () {
    // 商品一覧（GET /products）
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // 商品検索（GET /products/search）
    Route::get('/search', [ProductController::class, 'search'])->name('search');

    // 商品登録（フォーム表示＋登録処理）
    Route::get('/register', [ProductController::class, 'create'])->name('create');
    Route::post('/register', [ProductController::class, 'store'])->name('store');

    // 商品編集ページ（GET /products/{product}/edit）
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');

    // 商品更新（PUT /products/{product}/update）
    Route::put('/{product}/update', [ProductController::class, 'update'])->name('update');

    // 商品削除（DELETE /products/{product}）
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('delete');
});