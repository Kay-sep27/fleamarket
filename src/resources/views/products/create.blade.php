@extends('layouts.app')

@section('title', '商品登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="form-container">

    <h1 class="form-title">商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <label>商品名 <span class="required">必須</span></label>
            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
        </div>

        <!-- 値段 -->
        <div class="form-group">
            <label>値段 <span class="required">必須</span></label>
            <input type="number" name="price" placeholder="値段を入力" value="{{ old('price') }}">
        </div>

        <!-- 商品画像 -->
        <div class="form-group">
            <label>商品画像 <span class="required">必須</span></label>
            <input type="file" name="image">
        </div>

        <!-- 季節 -->
        <div class="form-group">
            <label>季節 <span class="required">必須</span><span class="note">　複数選択可</span></label>
            <div class="season-checkboxes">
                @foreach($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}">
                    {{ $season->name }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- 商品説明 -->
        <div class="form-group">
            <label>商品説明 <span class="required">必須</span></label>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        </div>

        <!-- ボタン -->
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-gray">戻る</a>
            <button type="submit" class="btn-yellow">登録</button>
        </div>
    </form>
</div>
@endsection