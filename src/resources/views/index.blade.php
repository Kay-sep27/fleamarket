@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}?v={{ time() }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ time() }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>お問い合わせ</h2>
  </div>

  <form class="form" action="/confirm" method="POST">
    @csrf

    <!-- お名前 -->
    <div class="form__group">
      <label class="form__label">お名前<span class="form__label--required">※</span></label>
      <div class="form__input-wrapper" style="display: flex; gap: 10px;">
        <input type="text" name="last_name" placeholder="姓（例：山田）" value="{{ old('last_name') }}">
        <input type="text" name="first_name" placeholder="名（例：太郎）" value="{{ old('first_name') }}">
      </div>
      @error('last_name') <p class="form__error">{{ $message }}</p> @enderror
      @error('first_name') <p class="form__error">{{ $message }}</p> @enderror
    </div>

    <!-- 性別 -->
    <div class="form__group">
      <label class="form__label">性別<span class="form__label--required">※</span></label>
      <div class="radio-group">
        <label><input type="radio" name="gender" value="男性" {{ old('gender', '男性') == '男性' ? 'checked' : '' }}> 男性</label>
        <label><input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性</label>
        <label><input type="radio" name="gender" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}> その他</label>
      </div>
      @error('gender') <p class="form__error">{{ $message }}</p> @enderror
    </div>

    <!-- メール -->
    <div class="form__group">
      <label class="form__label">メールアドレス<span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}">
      </div>
      @error('email') <p class="form__error">{{ $message }}</p> @enderror
    </div>

    <!-- 電話番号 -->
    <div class="form__group">
      <label class="form__label">電話番号<span class="form__label--required">※</span></label>
      <div class="form__input-wrapper tel-inputs">
        <input type="text" name="tel1" maxlength="5" value="{{ old('tel1') }}"> -
        <input type="text" name="tel2" maxlength="4" value="{{ old('tel2') }}"> -
        <input type="text" name="tel3" maxlength="4" value="{{ old('tel3') }}">
      </div>
      @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
        <p class="form__error">
          {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
        </p>
      @endif
    </div>

    <!-- 住所 -->
    <div class="form__group">
      <label class="form__label">住所<span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <input type="text" name="address" placeholder="市区町村・番地など" value="{{ old('address') }}">
      </div>
      @error('address') <p class="form__error">{{ $message }}</p> @enderror
    </div>

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
          <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
          <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
          <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
          <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
          <option value="5" {{ old('category_id') == 5 ? 'selected' : '' }}>その他</option>
        </select>
      </div>
      @error('category_id') <p class="form__error">{{ $message }}</p> @enderror
    </div>

    <!-- 内容 -->
    <div class="form__group">
      <label class="form__label">お問い合わせ内容<span class="form__label--required">※</span></label>
      <div class="form__input-wrapper">
        <textarea name="content" placeholder="お問い合わせ内容を入力してください" maxlength="120">{{ old('content') }}</textarea>
      </div>
      @error('content') <p class="form__error">{{ $message }}</p> @enderror
    </div>

    <!-- 送信 -->
    <div class="confirm-buttons">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>

  </form>
</div>
@endsection