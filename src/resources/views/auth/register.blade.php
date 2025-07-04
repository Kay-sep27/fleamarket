@extends('layouts.app')

@section('content')
<div class="form">
  <h2>新規登録</h2>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- 名前入力 -->
    <div class="form__group">
      <label>名前</label>
      <input type="text" name="name" value="{{ old('name') }}">
      @error('name')
        <p class="form__error">{{ $message }}</p>
      @enderror
    </div>

    <!-- メール入力 -->
    <div class="form__group">
      <label>メールアドレス</label>
      <input type="email" name="email" value="{{ old('email') }}">
      @error('email')
        <p class="form__error">{{ $message }}</p>
      @enderror
    </div>

    <!-- パスワード -->
    <div class="form__group">
      <label>パスワード</label>
      <input type="password" name="password">
      @error('password')
        <p class="form__error">{{ $message }}</p>
      @enderror
    </div>

    <!-- パスワード確認（※エラーメッセージ不要） -->
    <div class="form__group">
      <label>パスワード確認</label>
      <input type="password" name="password_confirmation">
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">登録</button>
    </div>
  </form>
</div>
@endsection

