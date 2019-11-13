<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetHomeController extends Controller
{
    public function index(){
        return view('diaryHome');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('Login.diaryLogin');
    }
}
