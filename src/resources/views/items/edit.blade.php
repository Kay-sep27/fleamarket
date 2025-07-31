@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@section('content')
<div class="container">
    <h1>商品を編集する</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">商品名</label>
            <input type="text" name="name" value="{{ old('name', $item->name) }}" required>
        </div>

        <div>
            <label for="price">価格（円）</label>
            <input type="number" name="price" value="{{ old('price', $item->price) }}" required>
        </div>

        <div>
            <label for="description">商品説明</label>
            <textarea name="description" rows="4" required>{{ old('description', $item->description) }}</textarea>
        </div>

        <div>
            <label for="image">現在の画像</label><br>
            @if ($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="商品画像" style="max-width: 100px; height: auto;">
            @else
                <p>画像は登録されていません。</p>
            @endif
        </div>

        <div>
            <label for="image">新しい画像をアップロード（任意）</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit">変更を保存</button>
    </form>
</div>
@endsection