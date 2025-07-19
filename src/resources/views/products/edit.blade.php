
@extends('layouts.app')

@section('title', '商品編集')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="breadcrumb">
    <a href="{{ route('products.index') }}">商品一覧</a> ＞ {{ $product->name }}
</div>

<div class="edit-container">
    <!-- 左：画像 -->
    <div class="image-column">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="image-preview">
        @endif
        <div class="file-upload">
            <input type="file" name="image" id="imageInput">
            <span id="fileNameText" class="file-name-preview"></span>
        </div>
        @error('image')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <!-- 右：フォーム -->
    <div class="form-column">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>値段</label>
                <input type="text" name="price" value="{{ old('price', $product->price) }}" placeholder="0〜10000円以内で入力">
                @error('price')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>季節</label>
                <div class="season-group">
                    @foreach($seasons as $season)
                        <label>
                            <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                            {{ $season->name }}
                        </label>
                    @endforeach
                </div>
                @error('seasons')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>商品説明</label>
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="button-group">
                <button type="button" onclick="location.href='{{ route('products.index') }}'" class="btn btn-gray">戻る</button>
                <button type="submit" class="btn btn-yellow">変更を保存</button>
            </div>
        </form>
    </div>
</div>

<form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-red" title="削除">
        🗑
    </button>
</form>
@endsection

@section('js')
<script>
    document.getElementById('imageInput').addEventListener('change', function (event) {
        const fileName = event.target.files[0]?.name || '';
        document.getElementById('fileNameText').textContent = fileName;
    });
</script>
@endsection