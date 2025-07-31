<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

// ホームリダイレクト → 商品一覧へ
Route::get('/', fn() => redirect()->route('items.index'));

// 商品一覧
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// 商品登録フォーム
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

// 商品登録処理
Route::post('/items', [ItemController::class, 'store'])->name('items.store');

// 商品詳細
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

// 商品編集フォーム
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');

// 商品更新処理
Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');

// 商品削除処理
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');