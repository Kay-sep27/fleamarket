
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
  <h1 class="text-2xl font-bold mb-6 text-center">会員登録</h1>
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-4">
      <label for="name" class="block text-gray-700">ユーザー名</label>
      <input id="name" name="name" type="text" value="{{ old('name') }}"
             class="w-full p-3 rounded-2xl shadow focus:outline-none focus:ring-2 focus:ring-coral-red"
             required autofocus>
      @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700">メールアドレス</label>
      <input id="email" name="email" type="email" value="{{ old('email') }}"
             class="w-full p-3 rounded-2xl shadow focus:outline-none focus:ring-2 focus:ring-coral-red"
             required>
      @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>
    <div class="mb-4">
      <label for="password" class="block text-gray-700">パスワード</label>
      <input id="password" name="password" type="password"
             class="w-full p-3 rounded-2xl shadow focus:outline-none focus:ring-2 focus:ring-coral-red"
             required>
      @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>
    <div class="mb-6">
      <label for="password_confirmation" class="block text-gray-700">パスワード（確認用）</label>
      <input id="password_confirmation" name="password_confirmation" type="password"
             class="w-full p-3 rounded-2xl shadow focus:outline-none focus:ring-2 focus:ring-coral-red"
             required>
    </div>
    <button type="submit"
            class="w-full bg-coral-red text-white font-bold py-3 rounded-2xl shadow hover:bg-red-600 transition">
      登録する
    </button>
  </form>
  <p class="mt-4 text-center">
    既にアカウントをお持ちですか？
    <a href="{{ route('login') }}" class="text-light-blue">ログイン</a>
  </p>
</div>
@endsection
