<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // 全商品を取得（あとでページネーションに変えてもOK）
        $products = Product::all();

        // view に渡す
        return view('products.index', compact('products'));
    }
}