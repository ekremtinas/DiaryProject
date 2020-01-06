<?php

namespace App\Http\Controllers\UserHome;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class GetUserHomeController extends Controller
{
    public function index()
    {
        $maintenance=Maintenance::all();
        return view('UserHome.userHome')->with('maintenance',$maintenance);
    }
}
