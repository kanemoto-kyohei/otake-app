<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//carender.phpを読み込み
require_once('carenderclass.php');

//日付を取得するための下準備
$currentWeek = isset($_GET['week']) ? (int)$_GET['week'] : date('W');
  $currentYear = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

  $previousWeek = $currentWeek - 1;
  $previousYear = $currentYear;
  $nextWeek = $currentWeek + 1;
  $nextYear = $currentYear;

  if ($previousWeek < 1) {
    $previousWeek = 52;
    $previousYear--;
  }

  if ($nextWeek > 52) {
    $nextWeek = 1;
    $nextYear++;
  }

  function getDateForWeek($week, $year) {
    $dt = new DateTime();
    $dt->setISODate($year, $week);
    return $dt;
  }

  $startOfWeek = getDateForWeek($currentWeek, $currentYear);
  $datesOfWeek = array();
  for ($i = 0; $i < 7; $i++) {
    $datesOfWeek[] = clone $startOfWeek;
    $startOfWeek->modify('+1 day');
  }

  $holiday = array("1/1","1/2","1/9","2/11","2/23","3/21","4/29","5/3","5/4","5/5","7/17","8/11","9/18","9/23","10/9","11/3","11/23");
  $times = ["9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00"];  $japaneseWeekdays = array('日', '月', '火', '水', '木', '金', '土');
?>  
  
<?php
//ここからインスタンスの作成
$datetimes = [];
foreach($times as $time){
$datetimes[] = new Carender($datesOfWeek,$time,$holiday);
}
?>