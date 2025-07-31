@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
  <h1 class="text-2xl font-bold mb-6 text-center">ログイン</h1>
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-4">
      <label for="email" class="block text-gray-700">メールアドレス</label>
      <input id="email" name="email" type="email" value="{{ old('email') }}"
             class="w-full p-3 rounded-2xl shadow focus:outline-none focus:ring-2 focus:ring-coral-red"
             required autofocus>
      @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <div class="mb-6">
      <label for="password" class="block text-gray-700">パスワード</label>
      <input id="password" name="password" type="password"
             class="w-full p-3 rounded-2xl shadow focus:outline-none focus:ring-2 focus:ring-coral-red"
             required>
      @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
    </div>

    <button type="submit"
            class="w-full bg-coral-red text-white font-bold py-3 rounded-2xl shadow hover:bg-red-600 transition">
      ログイン
    </button>
  </form>
  <p class="mt-4 text-center">
    アカウントをお持ちでない方は
    <a href="{{ route('register') }}" class="text-light-blue">会員登録</a>
  </p>
</div>
@endsection