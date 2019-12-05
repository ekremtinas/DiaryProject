<?php

namespace App\Http\Controllers\Reset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetPasswordResetController extends Controller
{
   public function index()
   {
       return view('Reset.diaryReset');
   }
   public  function getResetConfirm(Request $resetuid)
   {

       return view('Reset.diaryResetConfirm')->with('resetuid',$resetuid);
   }
}
