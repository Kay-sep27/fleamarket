<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品編集</title>
</head>
<body>
    <h1>商品編集フォーム</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>商品名:</label><br>
            <input type="text" name="name" value="{{ old('name', $product->name) }}">
        </div>

        <div>
            <label>価格:</label><br>
            <input type="number" name="price" value="{{ old('price', $product->price) }}">
        </div>

        <div>
            <label>画像:</label><br>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100"><br>
            @endif
            <input type="file" name="image">
        </div>

        <div>
            <label>説明:</label><br>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label>季節（複数選択可）:</label><br>
            @foreach ($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit">更新する</button>
    </form>
</body>
</html>