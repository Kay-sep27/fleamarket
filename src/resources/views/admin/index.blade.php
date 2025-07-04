@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>お問い合わせ一覧</h2>

    <!-- CSV出力ボタン -->
    <div style="margin-bottom: 20px; text-align: right;">
      <a href="{{ route('export') }}">
        <button style="padding: 8px 16px; background-color: #00bfff; color: white; border: none; border-radius: 4px; cursor: pointer;">
          CSV出力
        </button>
      </a>
    </div>

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

    <!-- 一覧テーブル -->
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
              <!-- 詳細ボタン -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $contact->id }}">
                詳細
              </button>

              <!-- モーダル -->
              <div class="modal fade" id="modal{{ $contact->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $contact->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel{{ $contact->id }}">お問い合わせ詳細</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                    </div>
                    <div class="modal-body">
                      <p><strong>氏名：</strong>{{ $contact->last_name }} {{ $contact->first_name }}</p>
                      <p><strong>メール：</strong>{{ $contact->email }}</p>
                      <p><strong>性別：</strong>{{ $contact->gender }}</p>
                      <p><strong>住所：</strong>{{ $contact->address }}</p>
                      <p><strong>建物名：</strong>{{ $contact->building_name }}</p>
                      <p><strong>お問い合わせ内容：</strong>{{ $contact->detail }}</p>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="{{ route('admin.destroy', $contact->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- ページネーション -->
    <div class="pagination">
      {{ $contacts->links('vendor.pagination.default') }}
    </div>
  </div>
@endsection