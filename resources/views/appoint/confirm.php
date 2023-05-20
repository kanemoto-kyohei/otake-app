<?php 
$date = isset($_GET["date"])?$_GET["date"]:"Date is not found";
$time = isset($_GET["time"])?$_GET["time"]:"Date is not found";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/0UzjzpxAJORrT6k6jzIp6gRDG6lv8kG2A2j5sJ" crossorigin="anonymous">
    <title>Document</title>
</head>

<!-- d-flex フレックスボックスを使用して、子要素を柔軟に配置できます。-->
<!-- flex-column: このクラスは、フレックスボックスの子要素の配置方向を縦方向に変更します。-->
<!-- min-vh-100: このクラスは、要素の最小の高さをビューポートの高さの100%に設定します。-->

<body class="bg-dark text-info d-flex flex-column min-vh-100">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-center">
            <h2><?php echo $date ?></h2>
            <h2><?php echo $time ?></h2>
            <form action="" method="post">
                <label for="text_input">名前:</label><br>
                <input type="text" id="text_input" name="text_input" placeholder="名前を入力してください"><br>
                <input type="submit" value="確定">
            </form>
        </div>
    </div>
    
    <footer class="bg-dark text-white mt-auto py-3">
    <div class="container">        
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">カレンダーに戻る</a></li>
            <li class="breadcrumb-item active" aria-current="page">確定画面</li>
        </ol>
        </nav>
    </div>
    </footer>
    

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>