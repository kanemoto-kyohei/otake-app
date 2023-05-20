<!-- resources/views/link.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パーマリンク入力</title>
</head>
<body>
    <h1>任意のパーマリンク入力を入力してください</h1>
    @if(session('error'))
    <div class = "alert alert-danger">
        <p style = "color: red">{{ session('error') }}</p>
    </div>
    @endif
    @if(isset($error))
        <p style ="color: red">{{ $error }}</p>
    @endif
    <!-- メソッドをpostにしないとパーマリンクが飛ばせないのでのちの操作がうまくいかない -->
    <form action="{{ route('admin.linkset') }}" method="post">
        @csrf
        <label for="permalink">パーマリンク:</label>
        <input type="text" name="permalink" id="permalink" required>
        <button type="submit">送信</button>
    </form>
</body>
</html>
