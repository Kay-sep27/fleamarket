@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>お問い合わせ詳細</h2>

    <table border="1" cellpadding="10" cellspacing="0">
      <tr><th>ID</th><td>{{ $contact->id }}</td></tr>
      <tr><th>名前</th><td>{{ $contact->last_name }} {{ $contact->first_name }}</td></tr>
      <tr><th>性別</th><td>{{ $contact->gender }}</td></tr>
      <tr><th>メール</th><td>{{ $contact->email }}</td></tr>
      <tr><th>電話番号</th><td>{{ $contact->tel }}</td></tr>
      <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
      <tr><th>建物名</th><td>{{ $contact->building_name ?? '（未入力）' }}</td></tr>
      <tr><th>種類</th><td>{{ $contact->category->name }}</td></tr>
      <tr><th>内容</th><td>{{ $contact->content }}</td></tr>
      <tr><th>登録日時</th><td>{{ $contact->created_at }}</td></tr>
    </table>

    <br>
    <a href="{{ route('admin.index') }}">← 一覧に戻る</a>
  </div>
@endsection