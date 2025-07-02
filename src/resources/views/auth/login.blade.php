<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
</head>
<body>
  <h1>ログイン</h1>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <label>Email:
      <input type="email" name="email" required>
    </label><br>
    <label>Password:
      <input type="password" name="password" required>
    </label><br>
    <button type="submit">ログイン</button>
  </form>
</body>
</html>
