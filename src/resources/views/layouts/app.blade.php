<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'mogitate')</title>

  <!-- 共通CSS -->
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <!-- ページごとのCSS -->
  @yield('css')

  <!-- Bootstrap CSS（必要な場合のみ） -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <!-- ロゴ -->
      <a href="/" class="header__logo">mogitate</a>

      <!-- ナビゲーション -->
      <div class="header__nav">
        {{-- ログイン・ログアウトなど（今は不要なら削除してもOK） --}}
      </div>
    </div>
  </header>

  <main class="main-content">
    @yield('content')
  </main>

  <!-- Bootstrap JS（必要な場合のみ） -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>