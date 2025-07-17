<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
</head>
<body>
    <h1>商品登録内容の確認</h1>

    <div>
        <p><strong>商品名：</strong>{{ $data['name'] }}</p>
        <p><strong>価格：</strong>¥{{ number_format($data['price']) }}</p>
        <p><strong>説明：</strong>{{ $data['description'] ?? 'なし' }}</p>
        <p><strong>季節：</strong>
            @if($seasons->isNotEmpty())
                {{ $seasons->pluck('name')->implode(', ') }}
            @else
                なし
            @endif
        </p>

        @if ($imagePath)
            <p><strong>画像プレビュー：</strong></p>
            <img src="{{ asset('storage/' . $imagePath) }}" alt="画像プレビュー" width="200">
        @else
            <p><strong>画像：</strong>なし</p>
        @endif
    </div>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <input type="hidden" name="name" value="{{ $data['name'] }}">
        <input type="hidden" name="price" value="{{ $data['price'] }}">
        <input type="hidden" name="description" value="{{ $data['description'] }}">
        @if($imagePath)
            <input type="hidden" name="image_path" value="{{ $imagePath }}">
        @endif
        @foreach ($seasons as $season)
            <input type="hidden" name="seasons[]" value="{{ $season->id }}">
        @endforeach

        <button type="submit">登録する</button>
    </form>

    <form action="{{ route('products.create') }}" method="GET" style="margin-top: 20px;">
        <button type="submit">戻る</button>
    </form>
</body>
</html>