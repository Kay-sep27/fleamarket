<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品登録</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>商品登録フォーム</h1>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>※ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 登録フォーム --}}
    <form action="{{ route('products.confirm') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">商品名:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="price">価格（円）:</label><br>
            <input type="number" id="price" name="price" value="{{ old('price') }}">
        </div>

        <div class="form-group">
            <label for="image">画像:</label><br>
            <input type="file" id="image" name="image">
        </div>

        <div class="form-group">
            <label for="description">説明:</label><br>
            <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>季節（複数選択可）:</label><br>
            @foreach ($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit">登録する</button>
    </form>
</body>
</html>