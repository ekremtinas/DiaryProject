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
   public  function getResetChange()
   {
       return view('Reset.diaryResetChange');
   }
}
