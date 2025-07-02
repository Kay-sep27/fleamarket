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
        $contacts = Contact::with('category')->paginate(7);
        return view('admin.index', compact('contacts'));
    }

    // 追加ページの表示（通常は不要ですが教材準拠なら仮置き）
    public function add()
    {
        $categories = Category::all();
        return view('admin_add', ['categories' => $categories]);
    }

    // 追加処理（通常は使いませんが教材準拠で）
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
}
