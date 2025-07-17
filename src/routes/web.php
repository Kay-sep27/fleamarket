<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 商品一覧
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品登録フォーム
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// 商品登録フォームを表示
Route::get('/products/register', [ProductController::class, 'create'])->name('products.create');

// 商品登録処理
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 商品登録完了画面（オプション）
Route::get('/products/thanks', [ProductController::class, 'thanks'])->name('products.thanks');

// 商品詳細（任意）
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// 商品編集フォーム（任意）
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// 商品更新処理（任意）
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// 商品削除（任意）
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// 確認画面
Route::post('/products/confirm', [ProductController::class, 'confirm'])->name('products.confirm');

// 商品詳細画面
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// 削除画面
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.delete');

// 商品更新機能
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// 検索機能
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');