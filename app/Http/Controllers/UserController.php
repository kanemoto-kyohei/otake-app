<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Appoint;
use App\Services\AppointService;
use App\Http\Requests\Appoinnt\LinkConfirmRequest;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth; 
use App\Events\AppointCreated;
use Carbon\Carbon;


class UserController extends Controller
{
    //
    public function link(Request $request){
        $userId = Auth::id();
        $is_calendar = Calendar::where('user_id',$userId)->exists();
        if($is_calendar){
            $request->session()->flash('link','一つのアカウントにつきどちらかしか選べないのでご注意ください');
            return Inertia::render('Top');
        }else{
            return Inertia::render('UserLink');
        }
    }

    public function linkconfirm(LinkConfirmRequest $request)
    {
        //
        $user_permalink = $request->getlink();
        

        $is_calendar = Calendar::where('carender_link', $user_permalink)->exists();
        
        if (!$is_calendar) {
            $request->session()->flash('message','カレンダーが存在しません。リンクを修正してください');
            return Inertia::render('UserLink');
        }else{
        $appoint = new Appoint;

        $appoint->user_id = $request->userId();
        $appoint->carender_link = $user_permalink;
    
        $appoint->save();
        // 一致するレコードが存在する場合、次のルーティングに渡す
        return redirect()->route('appoint.inertiaIndex',[
            'user_permalink' => $user_permalink]);

        }
        }



    public function index(Request $request, AppointService $appointService,$user_permalink)
    {
      $today = Carbon::today();
      $pastappointments = Appoint::wheredate('date','<',$today)->get();
      foreach($pastappointments as $pastappointment){
        $pastappointment->delete();
      }
      $appointments = Appoint::where('carender_link', $user_permalink)->get();
      //データベースからdateとtimeのペアを取得して配列に代入
      $carender_elements = $appointService->getCarender();
      $userId = Auth::id(); // 現在の認証済みユーザーのIDを取得


      //index.blade.phpで使っている変数の値は全部飛ばしてあげる
      return Inertia::render('App',[
        'carender_elements' => $carender_elements,
        'user_permalink' => $user_permalink,
        'userId' => $userId,
        'appointments' => $appointments,

      ]);

    }

    public function confirm(Request $request)
    {
        $selectedDateTime = $request->input('selected_date_time');
        list($date, $time) = explode('|', $selectedDateTime);
        return Inertia::render('AppointConfirm',[
                'date'=>$date,
                'time'=>$time,
        ]
        );
    }

    public function set(Request $request)
    {
        //
        $userId = Auth::id();

        $appointdata = Appoint::where('user_id',$userId)->latest()->first();
        $carender_link = $appointdata->carender_link;

        $appoint = new Appoint;
        $appoint->user_id = $userId;       
        $appoint->carender_link = $carender_link;
        $selectedDateTime = $request->input('selected_date_time');
        list($date, $time) = explode('|', $selectedDateTime);
    
        $appoint->date = $date;
        $appoint->time = $time;

        //ここですでにテーブルに既存の予約がないかチェック
        $already_exists = Appoint::where('carender_link',$carender_link)
        ->where('date',$appoint->date)
        ->where('time',$appoint->time)
        ->exists();

        if(!$already_exists){
        $appoint->save();
        event(new AppointCreated($appoint));

        return Inertia::render('Done',[
            'date'=> $date,
            'time'=> $time,
            'user_permalink'=> $carender_link,

        ]);
        }else{
            $request->session()->flash('error','選択された日時はすでに他のユーザによって予約されています');
            return redirect()
            ->route('appoint.inertiaIndex', ['user_permalink'=>$carender_link]);
        }

    }

    public function deleteconf(Request $request)
    {
        //
        $appointDateTime = $request->input('selected_date_time');
        list($date, $time,$id) = explode('|', $appointDateTime);
        return Inertia::render('Delete',[
            'date'=>$date,
            'time'=>$time,
            'id'=>$id,

        ]);
           

    }

    public function delete(Request $request)
    {
        //
        $appointId = $request->input('selected_id');
        $appoint = Appoint::where('id', $appointId)->firstOrFail();
        $user_permalink = $appoint->carender_link;
        $appoint->delete();
        $request->session()->flash('message','予約をキャンセルしました');
        $message = $request->session()->get('message');
        return redirect()
        ->route('appoint.inertiaIndex',
        ['user_permalink'=>$user_permalink]);
    
    }





}
