<?php

namespace App\Http\Controllers\UserHome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostUserHomeController extends Controller
{
    public function index(Request $request)
    {
        $minuteSum=0;
        foreach ($request->maintenance as $row){
           $minute= strtotime(substr($row,1,5));
           $minuteSum=$minuteSum+$minute;
        }
        $minuteSumFormat=date('H:i:s', $minuteSum);
        \DebugBar::info($minuteSumFormat);
        return response($request);
    }
}
