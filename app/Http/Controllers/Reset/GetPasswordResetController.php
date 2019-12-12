<?php

namespace App\Http\Controllers\Reset;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetPasswordResetController extends Controller
{
   public function index()
   {
       return view('Reset.diaryReset');
   }
   public  function getResetConfirm(Request $resetuid)
   {
       if (User::where('email_verified_at',md5($resetuid['resetuid']))->first()) {
           return view('Reset.diaryResetConfirm')->with('resetuid', $resetuid);
       }
       else{
           return view("Reset.diaryReset")->with('please','Please re-enter your email');
       }

   }
   public  function getResetConfirmLogin(Request $resetuid)
   {
       $credentials = $resetuid->only('email_verified_at');
       if (User::where('email_verified_at',$resetuid['resetuid'])->first()) {

            if (Auth::guard($credentials)) {
Auth::login(User::where('email_verified_at',$resetuid['resetuid'])->first(),false);
               return redirect()->intended('dHome');
           }

       }
   }
}
