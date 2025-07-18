@extends('layouts.app')

@section('title', $product->name)

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container">

  <p class="breadcrumb">
    <a href="{{ route('products.index') }}">商品一覧</a> > {{ $product->name }}
  </p>

  <div class="product-detail-wrapper">

    {{-- 左：画像とアップロード欄 --}}
    <div class="product-detail-image">
      <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/noimage.png') }}" alt="{{ $product->name }}">
      <p class="image-filename">{{ $product->image ? basename($product->image) : '画像なし' }}</p>
      <input type="file" name="image" disabled>
    </div>

    {{-- 右：商品情報 --}}
    <div class="product-detail-info">

      <div class="field">
        <label>商品名</label>
        <input type="text" value="{{ $product->name }}" readonly>
      </div>

      <div class="field">
        <label>値段</label>
        <input type="text" value="¥{{ number_format($product->price) }}" readonly>
      </div>

      <div class="field">
        <label>季節</label>
        <div class="seasons">
          @php
            $seasonNames = ['春', '夏', '秋', '冬'];
            $productSeasons = $product->seasons->pluck('name')->toArray();
          @endphp
          @foreach ($seasonNames as $season)
            <span class="season-tag {{ in_array($season, $productSeasons) ? '' : 'disabled' }}">
              {{ in_array($season, $productSeasons) ? $season : 'なし' }}
            </span>
          @endforeach
        </div>
      </div>

      <div class="field">
        <label>商品説明</label>
        <textarea readonly>{{ $product->description }}</textarea>
      </div>

      <div class="actions">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">変更を保存</a>
        <a href="{{ route('products.index') }}" class="btn btn-light">戻る</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">削除</button>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection