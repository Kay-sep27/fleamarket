@extends('layouts.app')

@section('title', '商品編集')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container">

  <h2 class="page-title">商品情報を編集</h2>

  <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="product-detail-wrapper">

      {{-- 左：画像エリア --}}
      <div class="product-detail-image">
        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/noimage.png') }}" alt="{{ $product->name }}">
        <p class="image-filename">{{ basename($product->image) }}</p>

        <div class="field">
          <label for="image">画像アップロード</label>
          <input type="file" name="image" id="image">
        </div>
      </div>

      {{-- 右：商品情報エリア --}}
      <div class="product-detail-info">

        {{-- 商品名 --}}
        <div class="field">
          <label for="name">商品名</label>
          <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
        </div>

        {{-- 値段 --}}
        <div class="field">
          <label for="price">値段</label>
          <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}">
        </div>

        {{-- 季節チェックボックス --}}
        <div class="field">
          <label>季節</label>
          <div class="seasons">
            @foreach ($seasons as $season)
              <label>
                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                  {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                {{ $season->name }}
              </label>
            @endforeach
          </div>
        </div>

        {{-- 商品説明 --}}
        <div class="field">
          <label for="description">商品説明</label>
          <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- アクションボタン --}}
        <div class="actions">
          <button type="submit" class="btn btn-warning">変更を保存</button>
          <a href="{{ route('products.index') }}" class="btn btn-light">戻る</a>
        </div>

      </div>
    </div>
  </form>

</div>
@endsection