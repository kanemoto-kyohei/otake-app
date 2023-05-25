<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Calendar;
use App\Models\Appoint;
use Illuminate\Support\Facades\Auth; 
use App\Services\AppointService;


class AdminController extends Controller
{
    //
    public function adminlink(Request $request){
        $userId = Auth::id();
        $is_appoint = Appoint::where('user_id',$userId)->exists();
        if($is_appoint){
            $request->session()->flash('link','一つのアカウントにつきどちらかしか選べないのでご注意ください');
            return Inertia::render('Top');
        }else{
        return Inertia::render('AdminLink');
        }
    }

    public function linkset(Request $request)
    {
        //
        $admin_link = $request->input('permalink');
        $calendar = Calendar::where('carender_link',$admin_link)->first();
        $userId = Auth::id(); 
                       
        if(!$calendar){        
            $calendar = new Calendar;
            $calendar->carender_link = $request->input('permalink');
            $userId = Auth::id(); 
            $calendar->user_id = $userId;                        
            $calendar->save();
            return Inertia::render('Setting',[
                'permalink'=>$calendar->carender_link
            ]);
        }elseif($calendar->user_id == $userId ){
            return redirect()
            ->route('admin.inertiaIndex',['permalink' => $calendar->carender_link]);
        }else{
            $request->session()->flash('error','入力されたリンクはすでに別の管理者によって使用されています');
            return Inertia::render('AdminLink');

}
}

public function save(Request $request)
{
    //
    $userId = Auth::id();
    $calendar = Calendar::where('user_id',$userId)->firstOrFail();
    $permalink = $calendar->carender_link;

    $start_time = $request->input('start_time');
    $end_time = $request->input('end_time');
    $time_interval = $request->input('time_interval');
    $holiday_setting = $request->input('holiday_setting')?true:false;
    $weekday_slots = $request->input('weekday_slots');

    if($start_time >= $end_time){
        $request->session()->flash('message','時間を正しく設定してください');
        return Inertia::render('Setting');
    }elseif(fmod(($end_time - $start_time), $time_interval) != 0){
        $request->session()->flash('message','時間を正しく設定してください');
        return Inertia::render('Setting');
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
->route('admin.inertiaIndex',['permalink'=>$permalink]);



}

public function adminindex(Request $request, AppointService $appointService,$permalink)
{
    //
    $appointments = Appoint::with('user')
            ->where('carender_link',$permalink)
            ->whereNotNull('date')
            ->whereNotNull('time')
            ->get();
    

    $carender_elements = $appointService->getCarender($permalink);

    $calendarLink = url('https://otake-app.herokuapp.com/appoint/inertia/users/index/'.$permalink);
    return Inertia::render('AdminApp',[
        'carender_elements'=> $carender_elements,
        'appointments'=>$appointments,
        'calendarLink'=>$calendarLink,
    ]);
}

public function reset(Request $request)
{
    //
    $request->session()->flash('error','設定を変更する前に予約者に連絡してください');
    $error = $request->session()->get('error');
    return Inertia::render('Setting');
}






}
