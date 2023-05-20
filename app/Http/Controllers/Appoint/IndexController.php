<?php

namespace App\Http\Controllers\Appoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appoint;
use App\Services\AppointService;

//名前空間App\Models\Appointのcarenderクラスを取得する
use App\Models\Appoint\Carender;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AppointService $appointService,$user_permalink)
    {
      $appointments = Appoint::where('carender_link', $user_permalink)->get();
      //データベースからdateとtimeのペアを取得して配列に代入
      $appoints = $appointService->getAppoints();

      $carender_elements = $appointService->getCarender();

      //index.blade.phpで使っている変数の値は全部飛ばしてあげる
      return view('appoint.index')
        ->with('carender_elements', $carender_elements)
        ->with('appoints', $appoints)
        ->with('user_permalink',$user_permalink)
        ->with('appointments',$appointments);

    }
}
