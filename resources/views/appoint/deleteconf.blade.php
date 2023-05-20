<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/0UzjzpxAJORrT6k6jzIp6gRDG6lv8kG2A2j5sJ" crossorigin="anonymous">
    <title>完了画面</title>
</head>


<body class="bg-dark text-info d-flex flex-column min-vh-100">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-center">
            <!-- bladeテンプレートを使わないとcontrollerから飛んできた値を表示できない -->
            <h2>{{$date}}</h2>
            <h2>{{$time}}</h2>

            <p>予約をキャンセルしてもよろしいですか？</p>
            <form action ="{{ route('delete.index',['user_permalink'=>$user_permalink]) }}" method = "post">
                @method('DELETE')
                @csrf
            <input type="hidden" name="appointId" value="{{$appointId}}">
            <button type = "submit">キャンセル</button>
            </form>

            
          
        </div>
    </div>
    <footer class = 'text-center'>
        <form action ="{{ route('appoint.index',['user_permalink'=>$user_permalink]) }}">
            <button value='カレンダーに戻る' type = "sbumit">カレンダーに戻る</button>
        </form>
    </footer>
    

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>