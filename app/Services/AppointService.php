<?php

namespace App\Services;

use App\Models\Appoint;
use App\Models\Appoint\Carender;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth; 

class AppointService
{

  
    public function getCarender(){


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
      $dt = new \DateTime();
      $dt->setISODate($year, $week);
      return $dt;
    }
  
    $startOfWeek = getDateForWeek($currentWeek, $currentYear);
    $datesOfWeek = array();
    for ($i = 0; $i < 7; $i++) {
      $datesOfWeek[] = clone $startOfWeek;
      $startOfWeek->modify('+1 day');
    }

    $userId = Auth::id(); // 現在の認証済みユーザーのIDを取得
    //管理者がやろうとするとここで自分のカレンダーが表示されてしまう
    $calendar = Calendar::where('user_id',$userId)->first();
    if(!$calendar){
      $appoint = Appoint::where('user_id',$userId)->latest()->first();
      $calendar = Calendar::where('carender_link',$appoint->carender_link)->first();
    }
    //nullだった場合にエラーメッセージを出したい
    $times = [];
    //テーブルにはJSON型（文字列）として格納されているので、配列に戻さなくてはならない
    $times = json_decode($calendar->time_slots);
    $weekdays = json_decode($calendar->weekday_slots);

    //holidayについては真か偽かで配列に入れるものを変える
    if($calendar->is_holiday){
    $holiday = array("null","null");
    }else{
    $holiday = array("1/1","1/2","1/9","2/11","2/23","3/21","4/29","5/3","5/4","5/5","7/17","8/11","9/18","9/23","10/9","11/3","11/23");
    };
    $japaneseWeekdays = array('日', '月', '火', '水', '木', '金', '土');    

  $carender_elements = [
    'times' => $times,
    'currentWeek' => $currentWeek,
    'currentYear' => $currentYear,
    'previousWeek' => $previousWeek,
    'previousYear' => $previousYear,
    'nextWeek' => $nextWeek,
    'nextYear' => $nextYear,
    'startOfWeek' => $startOfWeek,
    'datesOfWeek' => $datesOfWeek,
    'japaneseWeekdays' => $japaneseWeekdays,
    'holiday' => $holiday,
    'weekdays' => $weekdays
];

  return $carender_elements;
    }
}