@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>お問い合わせ一覧</h2>

    <!-- 検索フォーム -->
<form method="GET" action="{{ route('admin.index') }}">
  <div style="margin-bottom: 20px;">
    名前：<input type="text" name="name" value="{{ request('name') }}">
    メール：<input type="text" name="email" value="{{ request('email') }}">
    性別：
    <select name="gender">
      <option value="">すべて</option>
      <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
      <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
      <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
    </select>
    種類：
    <select name="category_id">
      <option value="">すべて</option>
      <option value="1" {{ request('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
      <option value="2" {{ request('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
      <option value="3" {{ request('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
      <option value="4" {{ request('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
      <option value="5" {{ request('category_id') == 5 ? 'selected' : '' }}>その他</option>
    </select>
    日付：
    <input type="date" name="from" value="{{ request('from') }}"> 〜
    <input type="date" name="until" value="{{ request('until') }}">
    <button type="submit">検索</button>
    <a href="{{ route('admin.index') }}">リセット</a>
  </div>
</form>

    {{-- 🔽 一覧表示テーブル --}}
    <table border="1" cellpadding="10" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>名前</th>
          <th>メール</th>
          <th>性別</th>
          <th>種類</th>
          <th>登録日</th>
          <th>詳細</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($contacts as $contact)
        <tr>
          <td>{{ $contact->id }}</td>
          <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->gender }}</td>
          <td>{{ $contact->category->name }}</td>
          <td>{{ $contact->created_at->format('Y/m/d') }}</td>
          <td>
          <a href="{{ route('admin.show', $contact->id) }}">詳細</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $contacts->links() }}
  </div>
@endsection
