<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminIndexRequest;
use Illuminate\Support\Facades\Auth; 
use App\Models\Calendar;

class AdminIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AdminIndexRequest $request,$permalink)
    {
        
        $calendar = Calendar::where('carender_link',$permalink)->first();
        return redirect()
        ->route('admin.dashboard', 
        ['permalink' => $calendar->carender_link]);

        

        
    }
}
