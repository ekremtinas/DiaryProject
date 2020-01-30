<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetLoginController extends Controller
{
   public function index()
   {
       return view('Login.diaryLogin');
   }
}
