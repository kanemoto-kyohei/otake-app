<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$permalink)
    {
        //
        return view('admin.setting')
        ->with('permalink',$permalink);
    }
}
