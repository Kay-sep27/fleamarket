@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ time() }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<main class="thanks__content">
  <!-- 背景テキスト -->
  <div class="background-text">THANK YOU</div>

  <!-- メッセージ -->
  <div class="thanks__heading">
    <h2>お問い合わせありがとうございました</h2>
  </div>

  <!-- HOMEボタン -->
  <div class="thanks__button-area">
    <a href="/" class="home-button">HOME</a>
  </div>
</main>
@endsection