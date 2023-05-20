<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/0UzjzpxAJORrT6k6jzIp6gRDG6lv8kG2A2j5sJ" crossorigin="anonymous">
    <title>ユーザーセレクション</title>
</head>
<body>

<div class="container">
    <h1 class="text-center mt-5">いずれかを選択してください</h1>
    @if (session('error'))
    <div class="text-danger text-center mt-5">
        {{ session('error') }}
    </div>
    @endif
    <div class="d-flex justify-content-center mt-5">
    <form action="{{ route('admin.link') }}" method="post" class="mr-3">
            @csrf
            <button type="submit" class="btn btn-primary">管理者として続ける</button>
        </form>
    <form action="{{ route('appoint.link') }}" method="post" class="mr-3">
            @csrf
        <button type="submit" class="btn btn-primary">一般ユーザとして続ける</button>
    </form>
    </div>
</div>

</body>
</html>
