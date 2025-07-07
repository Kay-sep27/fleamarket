@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}?v={{ time() }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ time() }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
  <main class="confirm__content">
    <div class="confirm__heading">
      <h2>送信内容確認</h2>
    </div>

    <table class="confirm-table confirm-table__inner">
      <tr class="confirm-table__row">
        <th class="confirm-table__header">名前</th>
        <td class="confirm-table__text">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">性別</th>
        <td class="confirm-table__text">{{ $contact['gender'] }}</td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">メール</th>
        <td class="confirm-table__text">{{ $contact['email'] }}</td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">電話番号</th>
        <td class="confirm-table__text">{{ $contact['tel1'] }}-{{ $contact['tel2'] }}-{{ $contact['tel3'] }}</td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">住所</th>
        <td class="confirm-table__text">{{ $contact['address'] }}</td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">建物名</th>
        <td class="confirm-table__text">{{ $contact['building_name'] ?? '（未入力）' }}</td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">種類</th>
        <td class="confirm-table__text">
          @php
            $categories = [
              1 => '商品のお届けについて',
              2 => '商品の交換について',
              3 => '商品トラブル',
              4 => 'ショップへのお問い合わせ',
              5 => 'その他'
            ];
          @endphp
          {{ $categories[$contact['category_id']] ?? '不明' }}
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">内容</th>
        <td class="confirm-table__text">{{ $contact['content'] }}</td>
      </tr>
    </table>

    <div class="confirm-buttons">
      {{-- 送信ボタン（thanksへ） --}}
      <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        @foreach ($contact as $key => $value)
          <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <button type="submit">送信</button>
      </form>

      {{-- 修正ボタン --}}
      <form action="{{ route('contact.back') }}" method="POST">
        @csrf
        @foreach ($contact as $key => $value)
          <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <button class="form__button-submit--back" type="submit">修正</button>
      </form>
    </div>
  </main>
@endsection