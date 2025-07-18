<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
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

    // 商品登録
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

    // 商品詳細
    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
{
    $product = Product::findOrFail($id);
    $seasons = Season::all();

    return view('products.edit', compact('product', 'seasons'));
}

    public function update(Request $request, $id)
    {
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'seasons' => 'nullable|array',
        'seasons.*' => 'exists:seasons,id',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $product->image = $path;
    }

    $product->update([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'description' => $validated['description'],
    ]);

    $product->seasons()->sync($validated['seasons'] ?? []);

    return redirect()->route('products.index')->with('success', '更新しました！');
    }

    // 商品削除
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '削除しました');
    }

    // 確認画面
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

}