<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostRegisterController extends Controller
{
   public function index(Request $request)
   {
       try {
           $this->validate($request, [
               'email' => 'required|email',
               'password' => 'required|confirmed|alphaNum|min:6',
               'name' => 'required',
           ]);
           $password=$request->get('password');
           $password=Hash::make($password);

           $user_data = array(
               'email' => $request->get('email'),
               'password' => $password,
               'name' => $request->get('name'),
           );
           User::create($user_data);

           return back()->with('success','User Saved Success');
       }
       catch (\Exception $exception)
       {
           return back()->with('error','Wrong Login Details');
       }
   }
}
