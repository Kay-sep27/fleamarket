<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品検索</title>
</head>
<body>
    <h1>商品検索</h1>

    <form action="{{ route('products.search') }}" method="GET">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="商品名を入力">
        <button type="submit">検索</button>
    </form>

    <h2>検索結果</h2>

    @if($products->isEmpty())
        <p>該当する商品は見つかりませんでした。</p>
    @else
        <ul>
            @foreach ($products as $product)
                <li>
                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    （¥{{ number_format($product->price) }}）
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>