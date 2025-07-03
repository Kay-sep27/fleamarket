<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Confirm</title>
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">Dora×2 Fashion🛎️</a>
    </div>
  </header>

  <main class="confirm__content">
    <div class="confirm__heading">
      <h2>Confirm</h2>
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
        <td class="confirm-table__text">{{ $contact['category_id'] }}</td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">内容</th>
        <td class="confirm-table__text">{{ $contact['content'] }}</td>
      </tr>
    </table>

    {{-- ボタン部分 --}}
    <div class="form__button-wrapper">
      {{-- 送信ボタン（thanksへ） --}}
      <form action="{{ route('contact.thanks') }}" method="POST">
        @csrf
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
        <input type="hidden" name="email" value="{{ $contact['email'] }}">
        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
        <input type="hidden" name="address" value="{{ $contact['address'] }}">
        <input type="hidden" name="building_name" value="{{ $contact['building_name'] }}">
        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
        <input type="hidden" name="content" value="{{ $contact['content'] }}">

        <button class="form__button-submit" type="submit">送信</button>
      </form>

      <!-- 修正ボタン（背景なし・下線だけ） -->
      <form action="{{ route('contact.back') }}" method="POST">
      @csrf
      <button class="form__button-submit--back" type="submit">修正</button>
      </form>
    </div>
  </main>
</body>
</html>
