<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 一覧表示
    public function index()
    {
        $products = Product::with('seasons')->paginate(6);
        return view('products.index', compact('products'));
    }

    // 検索機能
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

    // 作成フォーム表示
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    // 登録処理
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'seasons'     => 'nullable|array',
            'seasons.*'   => 'integer|exists:seasons,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $product = Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'image'       => $imagePath,
            'description' => $request->description,
        ]);

        if ($request->filled('seasons')) {
            $product->seasons()->attach($request->seasons);
        }

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    // 確認画面（未使用なら削除OK）
    public function confirm(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'seasons'     => 'nullable|array',
            'seasons.*'   => 'integer|exists:seasons,id',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tmp', 'public');
            $request->merge(['image_path' => $path]);
        }

        $seasonNames = Season::whereIn('id', $request->seasons ?? [])->pluck('name');

        return view('products.confirm', [
            'data' => $request->all(),
            'seasonNames' => $seasonNames,
        ]);
    }

    // 商品詳細
    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 商品削除
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // 画像も削除したい場合
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '削除しました');
    }

    // 編集フォーム
    public function edit($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        return view('products.edit', compact('product', 'seasons'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'seasons'     => 'array',
            'seasons.*'   => 'integer|exists:seasons,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        // 新しい画像があれば保存＆差し替え
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->description = $request->description;
        $product->save();

        $product->seasons()->sync($request->seasons ?? []);

        return redirect()->route('products.index')->with('success', '商品情報を更新しました！');
    }
}