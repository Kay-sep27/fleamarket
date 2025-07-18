<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 商品一覧・検索
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// 商品登録
Route::get('/products/register', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 確認画面
Route::post('/products/confirm', [ProductController::class, 'confirm'])->name('products.confirm');

// 商品登録完了画面（任意）
Route::get('/products/thanks', [ProductController::class, 'thanks'])->name('products.thanks');

// 商品詳細
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// 商品編集・更新
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// 商品削除
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');