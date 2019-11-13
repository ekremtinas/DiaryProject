<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class PostLoginController extends Controller
{
    public function index(Request $request)
    {
     $this->validate($request,[
            'email'     =>'required|email',
            'password'  =>'required|alphaNum|min:6',

     ]);
     $user_data=array(
         'email' => $request->get('email'),
         'password' => $request->get('password')

     );
     if(Auth::attempt($user_data,true))
     {
         return redirect('diaryHome');
     }
     else{
         return back()->with('error','Wrong Login Details');
     }

    }
}
