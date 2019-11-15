<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetHomeController extends Controller
{
    public function index(){
        return view('diaryHome');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/dLogin');
    }
}
