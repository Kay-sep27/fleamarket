<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}?v={{ time() }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ time() }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        Dora×2 Fashion🛎️
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>
      <form class="form" action="/confirm" method="POST">
        @csrf

        <!-- 一部省略。基本構造はそのまま -->
<form class="form" action="/confirm" method="POST">
  @csrf

  <!-- お名前（姓・名） -->
  <div class="form__group">
    <label class="form__label">お名前<span class="form__label--required">※</span></label>
    <div class="form__input-wrapper" style="display: flex; gap: 10px;">
      <input type="text" name="last_name" placeholder="姓（例：山田）" value="{{ old('last_name') }}">
      <input type="text" name="first_name" placeholder="名（例：太郎）" value="{{ old('first_name') }}">
    </div>
  </div>
  @if ($errors->has('last_name'))
    <p class="form__error">{{ $errors->first('last_name') }}</p>
  @endif
  @if ($errors->has('first_name'))
    <p class="form__error">{{ $errors->first('first_name') }}</p>
  @endif

  <!-- 性別 -->
  <div class="form__group">
    <label class="form__label">性別<span class="form__label--required">※</span></label>
    <div class="radio-group">
    <label><input type="radio" name="gender" value="男性" checked> 男性</label>
    <label><input type="radio" name="gender" value="女性"> 女性</label>
    <label><input type="radio" name="gender" value="その他"> その他</label>
    </div>
  </div>
  @if ($errors->has('gender'))
    <p class="form__error">{{ $errors->first('gender') }}</p>
  @endif

  <!-- メールアドレス -->
  <div class="form__group">
    <label class="form__label">メールアドレス<span class="form__label--required">※</span></label>
    <div class="form__input-wrapper">
      <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}">
    </div>
  </div>
  @if ($errors->has('email'))
    <p class="form__error">{{ $errors->first('email') }}</p>
  @endif

  <!-- 電話番号 -->
  <div class="form__group">
    <label class="form__label">電話番号<span class="form__label--required">※</span></label>
    <div class="form__input-wrapper" style="gap: 8px;">
      <input type="text" name="tel1" maxlength="5" style="width: 60px;"> -
      <input type="text" name="tel2" maxlength="4" style="width: 60px;"> -
      <input type="text" name="tel3" maxlength="4" style="width: 60px;">
    </div>
  </div>
  @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
    <p class="form__error">
      {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
    </p>
  @endif

  <!-- 住所 -->
  <div class="form__group">
    <label class="form__label">住所<span class="form__label--required">※</span></label>
    <div class="form__input-wrapper">
      <input type="text" name="address" placeholder="市区町村・番地など" value="{{ old('address') }}">
    </div>
  </div>
  @if ($errors->has('address'))
    <p class="form__error">{{ $errors->first('address') }}</p>
  @endif

  <!-- 建物名 -->
  <div class="form__group">
    <label class="form__label">建物名</label>
    <div class="form__input-wrapper">
      <input type="text" name="building_name" placeholder="〇〇マンション101号室" value="{{ old('building_name') }}">
    </div>
  </div>

  <!-- 種類 -->
  <div class="form__group">
    <label class="form__label">お問い合わせの種類<span class="form__label--required">※</span></label>
    <div class="form__input-wrapper">
      <select name="category_id">
        <option value="">選択してください</option>
        <option value="1">商品のお届けについて</option>
        <option value="2">商品の交換について</option>
        <option value="3">商品トラブル</option>
        <option value="4">ショップへのお問い合わせ</option>
        <option value="5">その他</option>
      </select>
    </div>
  </div>
  @if ($errors->has('category_id'))
    <p class="form__error">{{ $errors->first('category_id') }}</p>
  @endif

  <!-- 内容 -->
  <div class="form__group">
    <label class="form__label">お問い合わせ内容<span class="form__label--required">※</span></label>
    <div class="form__input-wrapper">
      <textarea name="content" placeholder="お問い合わせ内容を入力してください" maxlength="120">{{ old('content') }}</textarea>
    </div>
  </div>
  @if ($errors->has('content'))
    <p class="form__error">{{ $errors->first('content') }}</p>
  @endif

  <!-- 送信 -->
  <div class="form__button">
    <button class="form__button-submit" type="submit">確認画面</button>
  </div>
</form>
    </div>
  </main>
</body>

</html>

