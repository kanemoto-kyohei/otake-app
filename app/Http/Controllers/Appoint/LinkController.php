<?php

namespace App\Http\Controllers\Appoint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        return view('appoint.link');
    }
}
