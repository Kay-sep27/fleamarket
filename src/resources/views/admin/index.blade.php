@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/export.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endsection

@section('content')
<div class="container">
  <h2>お問い合わせ一覧</h2>

  <!-- テーブル幅に合わせる -->
  <div class="admin-table-wrapper">

  <!-- 検索フォーム -->
  <form method="GET" action="{{ route('admin.index') }}">
  <div class="search-form-wrapper">
    <input type="text" name="keyword" class="search-input" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

    <select name="gender" class="search-select">
      <option value="">性別</option>
      <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
      <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
      <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
    </select>

    <select name="category_id" class="search-select">
      <option value="">お問い合わせの種類</option>
      @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
          {{ $category->name }}
        </option>
      @endforeach
    </select>

    <input type="date" name="contact_date" class="search-date">

    <div class="search-form-buttons">
      <button type="submit" class="search-btn">検索</button>
      <a href="{{ route('admin.index') }}" class="reset-button">リセット</a>
    </div>
  </div>
</form>

<!-- CSV出力ボタン（検索クエリを維持） -->
<a href="{{ route('admin.export', request()->query()) }}" class="export-button">エクスポート</a>

  <!-- ページネーション -->
  <div class="pagination pagination--top-right">
  {{ $contacts->appends(request()->query())->links('vendor.pagination.default') }}
  </div>

  <!-- 一覧テーブル -->
  <table class="admin-table">
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
          <button type="button" class="admin-detail-button" data-bs-toggle="modal" data-bs-target="#modal{{ $contact->id }}">詳細
          </button>

          <!-- モーダル -->
          <div class="modal fade" id="modal{{ $contact->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $contact->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <!-- ヘッダー -->
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel{{ $contact->id }}">お問い合わせ詳細</h5>
                  <button type="button" class="custom-close" data-bs-dismiss="modal" aria-label="閉じる">×</button>
                </div>

                <!-- 本文 -->
                <div class="modal-body">
                <div class="modal-row"><strong>お名前：</strong><span>{{ $contact->last_name }} {{ $contact->first_name }}</span></div>
                <div class="modal-row"><strong>性別：</strong><span>{{ $contact->gender }}</span></div>
                <div class="modal-row"><strong>メールアドレス：</strong><span>{{ $contact->email }}</span></div>
                <div class="modal-row"><strong>電話番号：</strong><span>{{ $contact->tel }}</span></div>
                <div class="modal-row"><strong>住所：</strong><span>{{ $contact->address }}</span></div>
                <div class="modal-row"><strong>建物名：</strong><span>{{ $contact->building_name }}</span></div>
                <div class="modal-row"><strong>お問い合わせの種類：</strong><span>{{ $contact->category->name }}</span></div>
                <div class="modal-row">
                  <strong>お問い合わせ内容：</strong>
                  <span class="modal-detail">{{ $contact->detail }}</span>
                </div>
                </div>

                <!-- フッター -->
                <div class="modal-footer">
                  <form method="POST" action="{{ route('admin.destroy', $contact->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="form__button-submit admin-delete-button">削除</button>
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
</div>
@endsection