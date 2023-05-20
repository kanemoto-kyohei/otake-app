<!-- resources/views/link.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パーマリンク入力</title>
</head>
<body>
    <h1>管理者に教えられたパーマリンク入力を入力してください</h1>
    @if (session('error'))
    <div class="text-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('appoint.linkconfirm') }}" method="post">
        @csrf
        <label for="permalink">パーマリンク:</label>
        <input type="text" name="user_permalink" id="user_permalink" required>
        <button type="submit">送信</button>
    </form>
</body>
</html>
