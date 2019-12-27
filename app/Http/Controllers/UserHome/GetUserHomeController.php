<?php

namespace App\Http\Controllers\UserHome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetUserHomeController extends Controller
{
    public function index()
    {
        return view('UserHome.userHome');
    }
}
