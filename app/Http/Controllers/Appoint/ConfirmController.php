<?php

namespace App\Http\Controllers\Appoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$user_permalink)
    {
        if ($request->has('selected_date_time')) {
            $selectedDateTime = $request->input('selected_date_time');
            list($date, $time) = explode('|', $selectedDateTime);
            return view('appoint.confirm')
                ->with('date', $date)
                ->with('time', $time)
                ->with('user_permalink',$user_permalink);
        } else {
            // Handle the case when 'selected_date_time' is not set (e.g. show an error message or redirect)
            return redirect()
            ->route('appoint.index', ['user_permalink' => $user_permalink]);
        }
    }
        }
