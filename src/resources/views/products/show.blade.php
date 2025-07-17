<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細</title>
</head>
<body>
    <h1>商品詳細</h1>

    <div>
        <strong>商品名：</strong> {{ $product->name }}
    </div>

    <div>
        <strong>価格：</strong> ¥{{ number_format($product->price) }}
    </div>

    <div>
        <strong>説明：</strong> {{ $product->description ?? 'なし' }}
    </div>

    <div>
        <strong>季節：</strong>
        @if ($product->seasons->isNotEmpty())
            @foreach ($product->seasons as $season)
                {{ $season->name }}
                @if (!$loop->last), @endif
            @endforeach
        @else
            なし
        @endif
    </div>

    <div>
        <strong>画像：</strong><br>
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="200">
        @else
            画像なし
        @endif
    </div>

    <a href="{{ route('products.index') }}">← 商品一覧に戻る</a>
</body>
</html>