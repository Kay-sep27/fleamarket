<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'DORA×2 FASHION')</title>

  <!-- 共通CSS -->
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- ページごとのCSS -->
  @yield('css')
</head>
<body>
  <header class="header">
    <div class="header__inner" style="display: flex; justify-content: space-between; align-items: center; max-width: 1230px; margin: 0 auto; height: 60px;">
      <!-- ロゴ（中央寄せ） -->
      <div style="flex: 1; text-align: center;">
        <a class="header__logo" href="/" style="font-size: 24px; font-weight: bold; text-decoration: none; color: #FFCB00;">
          DORA×2 FASHION
        </a>
      </div>

      <!-- ナビゲーションボタン（右寄せ） -->
      <div class="header__nav-right" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="header__nav-button" type="submit">ログアウト</button>
          </form>
        @else
          @if (request()->is('login'))
            <a class="header__nav-button" href="{{ route('register') }}">新規登録</a>
          @elseif (request()->is('register'))
            <a class="header__nav-button" href="{{ route('login') }}">ログイン</a>
          @else
            <a class="header__nav-button" href="{{ route('login') }}">ログイン</a>
            <a class="header__nav-button" href="{{ route('register') }}">新規登録</a>
          @endif
        @endauth
      </div>
    </div>
  </header>

  <main style="padding: 20px;">
    @yield('content')
  </main>

  <!-- Bootstrap JS（モーダル表示用） -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>