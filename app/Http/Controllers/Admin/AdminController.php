<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appoint;
use App\Services\AppointService;


class AdminController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, AppointService $appointService,$permalink)
    {
        //
        $appoints = Appoint::where('carender_link',$permalink)
                ->whereNotNull('date')
                ->whereNotNull('time')
                ->get();

        $carender_elements = $appointService->getCarender();
  

        return view('admin.dashboard')
            ->with('carender_elements', $carender_elements)
            ->with('appoints', $appoints)
            ->with('permalink',$permalink);
    }
}
