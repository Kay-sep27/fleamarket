@extends('layouts.app')

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="product-header">
        <h1>商品一覧</h1>
        <a href="{{ route('products.create') }}" class="btn btn-warning">＋ 商品を追加</a>
    </div>

    <div class="sidebar-main-wrapper">

        <!-- サイドバー -->
        <div class="sidebar">
            <form action="{{ route('products.search') }}" method="GET" class="search-form">
                <label for="keyword">商品名・説明で検索</label>
                <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}" placeholder="商品名・説明で検索">
                <button type="submit">検索</button>

                <label for="sort">価格順で表示</label>
                <select id="sort" name="sort" onchange="location.href='?sort=' + this.value">
                    <option value="">価格で並べ替え</option>
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>安い順</option>
                    <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順</option>
                </select>
            </form>
        </div>

        <!-- 商品一覧 -->
        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/noimage.png') }}" alt="{{ $product->name }}">
                        <div class="product-info">
                            <span class="product-name">{{ $product->name }}</span>
                            <span class="product-price">¥{{ number_format($product->price) }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>

    <div class="pagination">
        {{ $products->links('vendor.pagination.default') }}
    </div>

</div>
@endsection