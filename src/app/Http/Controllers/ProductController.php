<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // 全商品を取得
        $products = Product::with('seasons')->paginate(6);

        return view('products.index', compact('products'));
    }

        public function search(Request $request)
    {
    $keyword = $request->input('keyword');

    $products = Product::query()
        ->when($keyword, function ($query, $keyword) {
            $query->where('name', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%");
        })
        ->get();

    return view('products.index', compact('products', 'keyword'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'seasons' => 'nullable|array',
            'seasons.*' => 'integer|exists:seasons,id',
        ]);

        // 画像保存
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // 商品登録
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        // 中間テーブルへの関連付け
        if ($request->filled('seasons')) {
            $product->seasons()->attach($request->seasons);
        }

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    public function confirm(Request $request)
    {
    // バリデーション
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
        'seasons' => 'nullable|array',
        'seasons.*' => 'integer|exists:seasons,id',
    ]);

    // 一時的に画像ファイルを保存（確認画面のため）
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('tmp', 'public');
        $request->merge(['image_path' => $path]);
    }

    // 確認画面へ
    return view('products.confirm', [
        'data' => $request->all(),
        'seasonNames' => \App\Models\Season::whereIn('id', $request->seasons ?? [])->pluck('name'),
    ]);
    }

    public function show($id)
    {
    $product = Product::with('seasons')->findOrFail($id);
    return view('products.show', compact('product'));
    }

    public function destroy($id)
    {
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')->with('success', '削除しました');
    }

    public function edit($id)
{
    $product = Product::with('seasons')->findOrFail($id);
    $seasons = Season::all();

    return view('products.edit', compact('product', 'seasons'));
}

public function update(Request $request, $id)
    {
    $product = Product::findOrFail($id);

    // バリデーション
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
        'seasons' => 'nullable|array',
        'seasons.*' => 'integer|exists:seasons,id',
    ]);

    // 画像アップロード（新しい画像があれば上書き）
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $product->image = $imagePath;
    }

    // 更新
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->save();

    // 季節の更新（detach→attach）
    $product->seasons()->sync($request->seasons ?? []);

    return redirect()->route('products.index')->with('success', '商品を更新しました！');
    }
}