<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // 商品一覧表示
    public function index()
    {
        $items = Item::latest()->paginate(12);
        return view('items.index', compact('items'));
    }

    // 商品詳細表示
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    // 商品登録フォーム表示
    public function create()
    {
        return view('items.create');
    }

    // 商品登録処理
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|integer|min:0|max:100000',
        'description' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    $path = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
    }

    Item::create([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'description' => $validated['description'],
        'image' => $path,
        'user_id' => auth()->id(), // ログインユーザー
    ]);

    return redirect()->route('items.index')->with('success', '商品を登録しました');
}


    // 商品編集フォーム表示
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    // 商品更新処理
    public function update(Request $request, Item $item)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|integer|min:0|max:100000',
        'description' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    if ($request->hasFile('image')) {
        $item->image = $request->file('image')->store('images', 'public');
    }

    $item->update([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'description' => $validated['description'],
        'image' => $item->image,
    ]);

    return redirect()->route('items.index')->with('success', '商品を更新しました');
}
}