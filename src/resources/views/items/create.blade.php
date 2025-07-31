@extends('layouts.app')

{{-- CSSの読み込み --}}
@section('head')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品を登録する</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">商品名</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="price">価格（円）</label>
            <input type="number" name="price" value="{{ old('price') }}" required>
        </div>

        <div>
            <label for="description">商品説明</label>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="image">商品画像（任意）</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit">登録する</button>
    </form>
</div>
@endsection