@extends('layouts.app')

@section('title', $product->name)

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="detail-container">
    <a href="{{ route('products.index') }}" class="back-link">← 商品一覧へ</a>

    <div class="detail-card">
        <!-- 商品画像 -->
        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/noimage.png') }}" 
             alt="{{ $product->name }}" class="detail-image">

        <!-- 商品情報 -->
        <h2 class="detail-name">{{ $product->name }}</h2>
        <p class="detail-price">¥{{ number_format($product->price) }}</p>

        <!-- 季節タグ（ある場合のみ表示）-->
        @if ($product->seasons->isNotEmpty())
        <div class="detail-seasons">
            @foreach ($product->seasons as $season)
                <span class="season-tag">{{ $season->name }}</span>
            @endforeach
        </div>
        @endif

        <!-- 商品説明 -->
        <p class="detail-description">{{ $product->description }}</p>
    </div>
</div>
@endsection