<?php

namespace App\Http\Controllers\Appoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appoint;

class DeleteConfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$user_permalink)
    {
        //
        $appointId = (int) $request->route('appointId');
        $appointDateTime = $_POST['appoint_date_time'];
        list($date, $time) = explode('|', $appointDateTime);
        return view('appoint.deleteconf')
                ->with('date', $date)
                ->with('time', $time)
                ->with('appointId', $appointId)
                ->with('user_permalink',$user_permalink);


    }
}
