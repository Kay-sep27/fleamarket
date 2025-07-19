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
        <!-- ▼ サイドバー（検索） -->
        <div class="sidebar">
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
            <div class="form-group">
                <label for="keyword"></label>
                <input type="text" id="keyword" name="keyword" value="{{ request('keyword') }}" placeholder="商品名を入力">
            </div>
            <button type="submit" class="btn-yellow">検索</button>
            <div class="form-group">
                <label for="sort">価格順で表示</label>
                <select id="sort" name="sort">
                <option value="">価格で並べ替え</option>
                <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>安い順に表示</option>
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順に表示</option>
                </select>
            </div>
            </form>
            @if(request('sort') === 'asc' || request('sort') === 'desc')
                <form action="{{ route('products.index') }}" method="GET" class="sort-tag-form">
                    {{-- キーワードも残すなら --}}
                    @if(request('keyword'))
                        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                    @endif
                    <div class="sort-tag">
                        <span>{{ request('sort') === 'asc' ? '安い順に表示' : '高い順に表示' }}</span>
                        <button type="submit" name="sort" value="" class="sort-tag-remove">×</button>
                    </div>
                </form>
            @endif
        </div>

        <!-- ▼ 商品一覧 -->
        <div class="products-wrapper">
            @foreach ($products as $product)
            <div class="product-card">
                <a href="{{ route('products.show', $product->id) }}">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <p>{{ $product->name }}</p>
                    <p>¥{{ number_format($product->price) }}</p>
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