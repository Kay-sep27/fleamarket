@extends('layouts.app')

@section('title', '商品編集')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="edit-container">
    <a href="{{ route('products.index') }}" class="back-link">← 商品一覧</a>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
        @csrf
        @method('PUT')

        <div class="form-image-preview">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="preview-img">
            <input type="file" name="image">
        </div>

        <div class="form-group">
            <label>商品名</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}">
        </div>

        <div class="form-group">
            <label>値段</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}">
        </div>

        <div class="form-group">
            <label>季節（複数選択可）</label><br>
            @foreach($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
            @endforeach
        </div>

        <div class="form-group">
            <label>商品説明</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-gray">戻る</a>
            <button type="submit" class="btn-yellow">変更を保存</button>
        </div>
    </form>
</div>
@endsection