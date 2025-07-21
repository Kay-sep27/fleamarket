@extends('layouts.app')

@section('title', '商品編集')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="breadcrumb">
  <a href="{{ route('products.index') }}">商品一覧</a> &gt; {{ $product->name }}
</div>

<div class="form-wrapper">
  {{-- ✅ 更新フォーム（保存） --}}
  <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="edit-container">
      {{-- 左カラム：画像 --}}
      <div class="image-column">
        <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" class="product-card-image">
        <div class="file-upload">
          <label for="image" class="custom-file-label">
            ファイルを選択
            <input type="file" name="image" id="image" class="custom-file-input">
          </label>
          <span id="fileNameText">{{ basename($product->image) }}</span>
        </div>
      </div>

      {{-- 右カラム：商品名・値段・季節 --}}
        <div class="form-column">
        {{-- 商品名 --}}
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        {{-- 値段 --}}
        <div class="form-group">
            <label for="price">値段</label>
            <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}">
            @error('price')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        {{-- 季節 --}}
        <div class="form-group">
            <label>季節</label>
            <div class="season-group">
            @foreach ($seasons as $season)
                <label>
                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                    {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                {{ $season->name }}
                </label>
            @endforeach
            </div>
            @error('seasons')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        </div> <!-- /.form-column -->
        </div> <!-- /.edit-container -->

        {{-- 商品説明欄 --}}
        <div class="description-block">
        <div class="form-group description-group">
            <label for="description">商品説明</label>
            <textarea name="description" id="description" class="description-textarea">{{ old('description', $product->description) }}</textarea>
            @error('description')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        </div>

    {{-- ✅ 戻る＆変更ボタン（中央） --}}
    <div class="button-group-with-trash">
      <div class="main-buttons">
        <a href="{{ route('products.index') }}" class="btn btn-gray">戻る</a>
        <button type="submit" class="btn btn-yellow">変更を保存</button>
      </div>
  </form> {{-- ←保存フォームここで終了！ --}}

  {{-- ✅ 削除フォーム（独立） --}}
  <form action="{{ route('products.delete', $product->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-button">
      <i class="fa-solid fa-trash"></i>
    </button>
  </form>
</div> <!-- /.button-group-with-trash -->

@endsection

@section('js')
<script>
  document.getElementById('image').addEventListener('change', function (e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : '選択されていません';
    document.getElementById('fileNameText').textContent = fileName;
  });
</script>
@endsection