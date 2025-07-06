<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    // 一覧表示
    public function index(Request $request)
{
    $query = Contact::with('category');

    // 名前で検索（姓 or 名に一致するもの）
    if ($request->filled('name')) {
        $query->where(function ($q) use ($request) {
            $q->where('last_name', 'like', '%' . $request->name . '%')
              ->orWhere('first_name', 'like', '%' . $request->name . '%');
        });
    }

    // メールアドレスで検索
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    // 性別で検索
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    // 種類（カテゴリ）で検索
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 登録日の範囲検索（from〜to）
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }
    if ($request->filled('until')) {
        $query->whereDate('created_at', '<=', $request->until);
    }

    // ページネーション（7件ずつ）
    $contacts = $query->paginate(7);

    return view('admin.index', compact('contacts'));
}

    // 追加ページの表示
    public function add()
    {
        $categories = Category::all();
        return view('admin_add', ['categories' => $categories]);
    }

    // 追加処理
    public function create(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Contact::create($form);
        return redirect('/admin');
    }

    // 編集ページの表示
    public function edit(Request $request)
    {
        $contact = Contact::find($request->id);
        $categories = Category::all();
        return view('admin_edit', ['contact' => $contact, 'categories' => $categories]);
    }

    // 更新処理
    public function update(Request $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Contact::find($request->id)->update($form);
        return redirect('/admin');
    }

    // 削除処理
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    // 詳細画面の表示
    public function show($id)
    {
    $contact = Contact::with('category')->findOrFail($id);
    return view('admin.show', compact('contact'));
    }

    // データ消去
    public function destroy($id)
    {
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました');
}
}
