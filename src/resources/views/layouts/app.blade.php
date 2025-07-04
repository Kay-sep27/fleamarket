<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせフォーム</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  @yield('css')
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">Contact Form</a>
      <nav class="header__nav">
      @auth
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit">ログアウト</button>
        </form>
      @else
        <a href="{{ route('login') }}">ログイン</a>
        <a href="{{ route('register') }}">新規登録</a>
      @endauth
      </nav>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
  <!-- モーダル表示のためのBootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
