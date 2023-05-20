<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;

class SettingSaveController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$permalink)
    {
        //
        $calendar = Calendar::where('carender_link',$permalink)->firstOrFail();

        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $time_interval = $request->input('time_interval');
        $holiday_setting = $request->input('holiday_setting')?true:false;

        $weekday_slots =[];
        $weekday_slots = $request->input('weekday_slots');
        for($i=1;$i<=7;$i++){
            if($request->has("day_$i")){
                $weekday_slots[]=$request->input("day_$i");
            }
        }

        if($start_time >= $end_time){
           return view('admin.setting',['permalink'=> $permalink,'error'=> '時間を正しく設定してください']);
        }elseif(fmod(($end_time - $start_time), $time_interval) != 0){
            return view('admin.setting',['permalink'=> $permalink,'error'=> '時間を正しく設定してください']);
        }else{
        $time_slots = [];
        for($time = $start_time;$time<$end_time;$time+=$time_interval){
            $time_slots[] = sprintf('%02d:%02d',floor($time),($time*60)%60);
        }
    }

    $calendar->update([
        'time_slots'=>json_encode($time_slots),
        'weekday_slots'=>json_encode($weekday_slots),
        'is_holiday' => $holiday_setting,
    ]);
    return redirect()
    ->route('admin.index',['permalink'=>$permalink]);



    }
}
