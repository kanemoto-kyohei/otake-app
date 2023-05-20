<?php 
//テスト用ファイル
require_once("data.php");

foreach($datetimes as $datetime){
    echo $datetime->gettime()."<br>";
    foreach ($datetime->getdatesOfWeek() as $date) {
        $weekday = $japaneseWeekdays[$date->format('w')];
        echo $date->format("n/j"). ' (' . $weekday . ')'."<br>";
    }
}

foreach ($datetime->getholiday() as $date) {
    echo $date."<br>";
}





?>