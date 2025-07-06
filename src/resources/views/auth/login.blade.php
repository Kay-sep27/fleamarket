@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
  <div class="form">
    <h2>ログイン</h2>
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form__group">
        <label>メールアドレス</label>
        <input type="email" name="email" required>
        @error('email')
          <p class="form__error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form__group">
        <label>パスワード</label>
        <input type="password" name="password" required>
        @error('password')
          <p class="form__error">{{ $message }}</p>
        @enderror
      </div>

      <div class="form__button">
      <button class="form__button-submit" type="submit">ログイン</button>
    </div>
    </form>
  </div>
@endsection