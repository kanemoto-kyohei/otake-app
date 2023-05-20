<?php

namespace App\Http\Controllers\Appoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Appointディレクトリが二つ存在するため、うまく動作していなかった
use App\Http\Requests\Appoinnt\LinkConfirmRequest;
use Illuminate\Support\Facades\Auth; 
use App\Models\Appoint;
use App\Models\Calendar;
use Inertia\Inertia;


class LinkConfirmController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LinkConfirmRequest $request)
    {
        //
        $user_permalink = $request->getlink();
        

        // パーマリンクが一致するレコードを取得
        $is_calendar = Calendar::where('carender_link', $user_permalink)->exists();
        // 一致するパーマリンクが存在しない場合、エラーメッセージを表示
        if (!$is_calendar) {
            return Inertia::render('UserLink',[
                'errors' => session('errors'),
            ]);
        }else{
        $appoint = new Appoint;

        $appoint->user_id = $request->userId();
        $appoint->carender_link = $user_permalink;
    
        $appoint->save();
        // 一致するレコードが存在する場合、次のルーティングに渡す
        return redirect()->route('appoint.index', [
            'user_permalink' => $user_permalink]);

        }
        }
}
