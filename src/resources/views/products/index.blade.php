@extends('layouts.app')

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="product-header">
        <h1>商品一覧</h1>
        <a href="{{ route('products.create') }}" class="btn btn-warning">＋ 商品を追加</a>
    </div>

    <form action="{{ route('products.search') }}" method="GET" class="search-form">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名・説明で検索">
        <button type="submit">検索</button>
    </form>

    <div class="sort-form">
        <label>価格順で表示</label>
        <select name="sort" onchange="location.href='?sort=' + this.value">
            <option value="">価格で並べ替え</option>
            <option value="asc">安い順</option>
            <option value="desc">高い順</option>
        </select>
    </div>

    <div class="product-grid">
        @foreach ($products as $product)
            <div class="product-card">
                <a href="{{ route('products.show', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>¥{{ number_format($product->price) }}</p>
                </a>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection