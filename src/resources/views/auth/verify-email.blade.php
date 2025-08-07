@extends('layouts.app')

@section('content')
<div class="verify-container">
    <div class="verify-box">
        <p class="verify-message-bold">登録していただいたメールアドレスに認証メールを送付しました。</p>
        <p class="verify-message">メール認証を完了してください。</p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="verify-button">認証はこちらから</button>
        </form>

        <div class="resend-link">
            <a href="{{ route('verification.send') }}">認証メールを再送する</a>
        </div>
    </div>
</div>
@endsection