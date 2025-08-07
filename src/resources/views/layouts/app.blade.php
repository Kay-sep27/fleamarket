<!DOCTYPE html>
<html lang="ja">
<head>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  <link rel="stylesheet" href="{{ asset('css/verify.css') }}">

  <header class="header">
    <div class="header__inner">
        <a href="{{ url('/') }}" class="logo-link">
            <img src="{{ asset('storage/images/logo.svg') }}" alt="サイトロゴ" class="logo-img">
        </a>
    </div>
  </header>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">

  <meta charset="UTF-8">
  <title>商品登録</title>
  <title>@yield('title', 'Coachtech Flea Market')</title>
</head>
<body>
  @yield('content')
</body>
</html>