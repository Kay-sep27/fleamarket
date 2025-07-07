<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    // 一覧表示
    public function index(Request $request)
{
    $query = Contact::with('category');

    // 名前 or メールアドレスで検索（keyword）
if ($request->filled('keyword')) {
    $query->where(function ($q) use ($request) {
        $q->where('last_name', 'like', '%' . $request->keyword . '%')
        ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
        ->orWhere('email', 'like', '%' . $request->keyword . '%');
    });
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
    $categories = Category::all();
    return view('admin.index', compact('contacts', 'categories'));
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

    // エクスポート機能
    public function export(Request $request)
{
    $query = Contact::with('category');

    // 🔍 検索条件（一覧と同じ）
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('last_name', 'like', "%{$keyword}%")
            ->orWhere('first_name', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('contact_date')) {
        $query->whereDate('created_at', $request->contact_date);
    }

    $contacts = $query->get();

    // CSV生成
    $csv = fopen('php://temp', 'r+');
    fputcsv($csv, ['ID', '名前', 'メールアドレス', '性別', 'お問い合わせ種別', '登録日']);

    foreach ($contacts as $contact) {
        fputcsv($csv, [
            $contact->id,
            $contact->last_name . ' ' . $contact->first_name,
            $contact->email,
            $contact->gender,
            $contact->category->name,
            $contact->created_at->format('Y-m-d'),
        ]);
    }

    rewind($csv);
    $filename = 'contacts_export_' . now()->format('Ymd_His') . '.csv';

    return response()->streamDownload(function () use ($csv) {
        fpassthru($csv);
    }, $filename, [
        'Content-Type' => 'text/csv',
    ]);
}
}