@extends('layouts.app')

@section('title', '商品登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="form-container">
    <h1 class="form-title">商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <label>商品名 <span class="required-badge">必須</span></label>
            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>

        <!-- 値段 -->
        <div class="form-group">
            <label>値段 <span class="required-badge">必須</span></label>
            <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price') <p class="error">{{ $message }}</p> @enderror
        </div>

        <!-- 商品画像 -->
        <div class="form-group">
            <label>商品画像 <span class="required-badge">必須</span></label>
            <input type="file" name="image" id="imageInput">
            <div id="preview-container">
                <img id="imagePreview" src="#" alt="プレビュー画像" style="display:none;">
                <p id="fileName"></p>
            </div>
            @error('image') <p class="error">{{ $message }}</p> @enderror
        </div>

        <!-- 季節 -->
        <div class="form-group">
            <label>季節 <span class="required-badge">必須</span><span class="small-label">複数選択可</span></label>
            <div class="form-group">

    <div class="checkbox-group">
        <label><input type="checkbox" name="seasons[]" value="1" {{ is_array(old('seasons')) && in_array(1, old('seasons')) ? 'checked' : '' }}> 春</label>
        <label><input type="checkbox" name="seasons[]" value="2" {{ is_array(old('seasons')) && in_array(2, old('seasons')) ? 'checked' : '' }}> 夏</label>
        <label><input type="checkbox" name="seasons[]" value="3" {{ is_array(old('seasons')) && in_array(3, old('seasons')) ? 'checked' : '' }}> 秋</label>
        <label><input type="checkbox" name="seasons[]" value="4" {{ is_array(old('seasons')) && in_array(4, old('seasons')) ? 'checked' : '' }}> 冬</label>
    </div>
    @error('seasons')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

        <!-- 説明 -->
        <div class="form-group">
            <label>商品説明 <span class="required-badge">必須</span></label>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description') <p class="error">{{ $message }}</p> @enderror
        </div>

        <!-- ボタン -->
        <div class="button-group">
            <button type="button" onclick="location.href='{{ route('products.index') }}'" class="btn-gray">戻る</button>
            <button type="submit" class="btn-yellow">登録</button>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
document.getElementById('imageInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const fileName = document.getElementById('fileName');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            fileName.textContent = file.name;
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        fileName.textContent = '';
    }
});
</script>
@endsection