<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\User;
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
         'password' => $request->get('password'),

     );
     //return User::where($user_data)->select()->first();
    if(Auth::attempt($user_data,$request->remember))
     {
         return redirect('dHome');
     }
     else{
         return back()->withInput()->with('error','Wrong Login Details');
     }

    }
}
