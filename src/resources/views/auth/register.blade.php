@extends('layouts.app')
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<div class="form-container">
  <h1 class="form-title">会員登録</h1>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
      <label for="name">ユーザー名</label>
      <input id="name" name="name" type="text" value="{{ old('name') }}" required>
      @error('name')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input id="email" name="email" type="email" value="{{ old('email') }}" required>
      @error('email')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label for="password">パスワード</label>
      <input id="password" name="password" type="password" required>
      @error('password')<div class="error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label for="password_confirmation">確認用パスワード</label>
      <input id="password_confirmation" name="password_confirmation" type="password" required>
    </div>

    <div class="button-group">
      <button type="submit" class="btn-yellow">登録する</button>
    </div>

    <p class="mt-4 text-center">
      <a href="{{ route('login') }}">ログインはこちら</a>
    </p>
  </form>
</div>
@endsection