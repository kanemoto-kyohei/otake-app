<?php

namespace App\Http\Controllers\Appoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appoint;
use App\Http\Requests\Appoinnt\SetRequest;
use App\Events\AppointCreated;

class SetController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SetRequest $request,$user_permalink)
    {
        //
        $appoint = new Appoint;

        $appoint->user_id = $request->userId();
        $appoint->carender_link = $user_permalink;
        $appoint->date = $request->setdate();
        $appoint->time = $request->settime();

        //ここですでにテーブルに既存の予約がないかチェック
        $already_exists = Appoint::where('carender_link',$user_permalink)
        ->where('date',$appoint->date)
        ->where('time',$appoint->time)
        ->exists();

        if(!$already_exists){
        $appoint->save();
        event(new AppointCreated($appoint));

        $date = $appoint->date;
        $time = $appoint->time;
        return view('appoint.set')
            ->with('date', $date)
            ->with('time', $time)
            ->with('user_permalink',$user_permalink);

        }else{
            return redirect()
            ->route('appoint.index', ['user_permalink'=>$user_permalink])
            ->with('error','申し訳ありませんが、該当の日時は他のユーザによってすでに予約されています');
        }

    }
}
