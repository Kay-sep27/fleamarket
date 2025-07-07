<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;


// お問い合わせフォーム（ユーザー側）
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// POSTがエラーになるので一時GETでthanksページ確認
//Route::get('/thanks-test', function () {
    //return view('thanks');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');

Route::post('/contact/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::post('/back', [ContactController::class, 'back'])->name('contact.back');

// 管理画面（ログイン後のみアクセス可能）
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/detail/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // CSVエクスポート（1つでOK）
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
});
