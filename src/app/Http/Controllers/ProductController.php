<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // 商品一覧表示
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('description', 'like', "%{$request->keyword}%");
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->paginate(6)->appends($request->all());

        return view('products.index', compact('products'));
    }

    // 商品検索
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

    // 商品作成フォーム
    public function create()
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    // 商品登録処理
    public function store(StoreProductRequest $request)
    {
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('images', 'public')
            : null;

        $product = Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'image'       => $imagePath,
            'description' => $request->description,
        ]);

        $product->seasons()->attach($request->seasons ?? []);

        return redirect()->route('products.index')->with('success', '商品を登録しました！');
    }

    // 商品編集フォーム
    public function edit($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();

        return view('products.edit', compact('product', 'seasons'));
    }

    // 商品更新処理
    public function update(UpdateProductRequest $request, $id)

    {

    $product = Product::findOrFail($id);

    // 画像の処理（ある場合のみ）
    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->image = $request->file('image')->store('images', 'public');
    }

    // その他のデータ更新
    $product->name        = $request->name;
    $product->price       = $request->price;
    $product->description = $request->description;

    // ←ここでまとめて保存
    $product->save();

    // 中間テーブル（季節）も更新
    $product->seasons()->sync($request->seasons);

    return redirect()->route('products.index')->with('success', '商品を更新しました！');
    }


    // 商品削除処理（DELETE /products/{id}）
    public function destroy(Request $request, $id)
    {
    $product = Product::findOrFail($id);

    // 画像がある場合は削除
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    // 中間テーブル（seasons）も削除（必要なら）
    $product->seasons()->detach();

    // 本体削除
    $product->delete();

    return redirect()->route('products.index')->with('success', '削除しました');
    }

    // 確認画面（登録の確認用）
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
            'data'        => $request->all(),
            'seasonNames' => $seasonNames,
        ]);
    }
}
