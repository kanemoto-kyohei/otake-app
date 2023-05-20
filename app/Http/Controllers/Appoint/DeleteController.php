<?php

namespace App\Http\Controllers\Appoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appoint;


class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$user_permalink)
    {
        //
        $appointId = $request->input('appointId');
        $appoint = Appoint::where('id', $appointId)->firstOrFail();
        $appoint->delete();
        return redirect()
                ->route('appoint.index',['user_permalink'=>$user_permalink])
                ->with('feedback.success', "予約をキャンセルしました");
    }
}
