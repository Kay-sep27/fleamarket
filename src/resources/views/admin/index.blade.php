@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>お問い合わせ一覧</h2>
    <table border="1" cellpadding="10" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>名前</th>
          <th>メール</th>
          <th>性別</th>
          <th>種類</th>
          <th>登録日</th>
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
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $contacts->links() }}
  </div>
@endsection
