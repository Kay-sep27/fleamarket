@extends('layouts.app')

@section('title', '商品一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="container">

    <!-- ヘッダー -->
    <div class="product-header">
        <h1>商品一覧</h1>
        <a href="{{ route('products.create') }}" class="btn btn-warning">＋ 商品を追加</a>
    </div>

    <!-- メインコンテンツ -->
    <div class="sidebar-main-wrapper">

        <!-- ▼ サイドバー（検索＆並び替え） -->
        <div class="sidebar">
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
                <div class="form-group">
                    <label for="keyword">商品名・説明で検索</label>
                    <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}" placeholder="商品名・説明で検索">
                </div>

                <div class="form-group">
                    <label for="sort">価格順で表示</label>
                    <select id="sort" name="sort">
                        <option value="">価格で並べ替え</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>安い順に表示</option>
                        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順に表示</option>
                    </select>
                </div>

                <button type="submit" class="btn-yellow">検索</button>
            </form>

            @if (request('sort'))
            <div class="sort-tag-wrapper">
                <span class="sort-tag">
                    {{ request('sort') === 'asc' ? '価格が低い順' : '価格が高い順' }}
                </span>
                <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}" class="sort-tag-reset">×</a>
            </div>
            @endif
        </div>

        <!-- ▼ 商品一覧 -->
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

    <!-- ▼ ページネーション -->
    <div class="pagination-wrapper">
        {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>

</div>
@endsection