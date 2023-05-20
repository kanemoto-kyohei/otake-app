<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\Appoint;
use Illuminate\Support\Facades\Auth; 


class LinkSetController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $calendar = new Calendar;
        $calendar->carender_link = $request->input('permalink');

        //以下で各リンクの管理者を検索し取得（管理者は各リンクの一番初めに来るので）
        $userId = Auth::id(); // 現在の認証済みユーザーのIDを取得
        $is_calendar = Calendar::where('carender_link',$calendar->carender_link)
                                ->exists();
        $calendar->user_id = $userId;                        
        if(!$is_calendar){
            $calendar->save();
            return view('admin.setting')
            ->with('permalink',$calendar->carender_link);           
        }elseif($calendar->user_id == $userId ){
            return redirect()
            ->route('admin.index',['permalink' => $calendar->carender_link]);
        }else{
            return view('admin.link',['permalink'=> $calendar->carender_link,'error'=> '入力されたリンクはすでに別の管理者によって使用されています']);

}
}
}
