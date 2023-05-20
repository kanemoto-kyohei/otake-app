<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  

  //休日とカラムの日付を照合する
  function holiday_find($date,$holidays){
      foreach($holidays as $holiday){
        if($holiday == $date){
          return true;
        }
      }
    return false;
  }

  //管理者が設定した休日とカラムの値を照合する
  function weekday_find($col,$weekdays){
    foreach($weekdays as $weekday){
      if($col == $weekday){
        return true;
      }
    }
    return false;
  }


  
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/0UzjzpxAJORrT6k6jzIp6gRDG6lv8kG2A2j5sJ" crossorigin="anonymous">
  <title>カレンダー</title>
</head>
<body class="bg-dark text-info">
@auth
<div class="container">
    <h1 class="text-center">カレンダー</h1>
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex justify-content-between my-3">
        <a href="?week=<?php echo $carender_elements['previousWeek']; ?>&year=<?php echo $carender_elements['previousYear']; ?>" class="btn btn-primary">前の週</a>
        <h3><?php echo $carender_elements['currentYear']. "年"; ?></h3>
        <a href="?week=<?php echo $carender_elements['nextWeek']; ?>&year=<?php echo $carender_elements['nextYear']; ?>" class="btn btn-primary">次の週</a>
        </div>

<!--カレンダーここから-->
<form action="{{ route('confirm.index',['user_permalink'=>$user_permalink]) }}" method="post">
  @csrf
        <table class="table table-bordered text-info">
         <thead>
            <tr>
            
             <th>時間</th>
             <!--配列の中に配列が入っているので、工夫が必要 -->
             <?php if (!empty($carender_elements['datetimes'])) : ?>
              <?php foreach ($carender_elements['datetimes'][0]->getdatesOfWeek() as $date) : ?>
              <?php $weekday = $carender_elements['japaneseWeekdays'][$date->format('w')]; ?>
              <th><?php echo $date->format("n/j") . ' (' . $weekday . ')'; ?></th>
              <?php endforeach ?>
            <?php endif ?>
            </tr>
         </thead>
         <tbody>
         <?php
//carenderのメソッドを使用している
$appointments = $appointments ?? [];
foreach ($carender_elements['datetimes'] as $datetime){
  echo "<tr>";
  echo "<td>" . $datetime->gettime() . "</td>";
  
  //ここからがカレンダーの中
  for ($col = 1; $col < 8; $col++) {
      echo "<td>";
      $date = $datetime->getdatesOfWeek()[$col - 1];
      $datesimple = $date->format('n/j');
      $is_appoint = false;
      $weekday = $carender_elements['japaneseWeekdays'][$date->format('w')];
      $formattedDate = $date->format('n/j') . ' (' . $weekday . ')';
      foreach ($appointments as $appointment) {
              if ($appointment['date'] == $formattedDate && $appointment['time'] == $datetime->gettime()) {
                  $is_appoint = true;
                  break;
          }
          if ($is_appoint) break;
      }

      if (weekday_find($col,$carender_elements['weekdays'])) {
          echo "x";
      } elseif (holiday_find($datesimple, $carender_elements['holiday'])) {
          echo "x";
      } elseif ($is_appoint) {
          echo "x";
      } else {
          echo '<input type="hidden" name="date" value="' . $formattedDate . '">';
          echo '<input type="hidden" name="time" value="' . $datetime->gettime() . '">';
          echo '<button type="submit" class="btn btn-outline-primary" name="selected_date_time" value="' . $formattedDate . '|' . $datetime->gettime() . '">';
          echo "◎";
          echo "</button>";
      }
      echo "</td>";
  }
  //ここまでカレンダーの中

  echo "</tr>";
}
        
         ?> 
         </tbody>
        </table>
    </form>
<!--カレンダーここまで-->

@if (session('feedback.success'))
  <p style="color: green">{{ session('feedback.success') }}</p>
@endif
@if (session('error'))
  <p style="color: red">{{ session('error') }}</p>
@endif

@foreach($appointments as $appointment)
  
  <!-- ここにifを入れて、ログインユーザのidと合致する予約だけを表示する-->
  @if(\Illuminate\Support\Facades\Auth::id() === $appointment['user_id']) 
<div class="d-flex align-items-center mb-3">
  
  <p class="mb-0 mr-2">{{ $appointment['date'] . ' ' . $appointment['time'] }}</p> 
  @if($appointment['date'] && $appointment['time'])
  <form action = "{{ route('deleteconf.index', [
    'appointId' => $appointment['id'],
    'user_permalink'=>$user_permalink
    ]) }}" method ="post">
    @csrf
    <button type ="submit" name = 'appoint_date_time' 
    value = "{{ $appointment['date'] . '|' . $appointment['time'] }}" 
    class="btn btn-danger">
      キャンセル</button>
      
  </form>
  @endif
  </div>
  @endif
@endforeach 

   
    </div>
</div>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>

@endauth

@guest
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mt-5">ログインしてください</h2>
            <div class="d-flex justify-content-center my-3">
                <a href="{{ route('login') }}" class="btn btn-primary">ログインページへ</a>
            </div>
        </div>
    </div>
</div>
@endauth

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
