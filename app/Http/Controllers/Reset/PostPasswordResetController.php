<?php

namespace App\Http\Controllers\Reset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PostPasswordResetController extends Controller
{

   public function index(Request $request)
   {

       $this->validate($request,[
           'email'     =>'required|email',
       ]);
       $user_data=array(
           'email' => $request->only('email'),

       );



       if(User::where($user_data)->first())
       {

           $data = [
               'email' => $request->get('email'),
               'resetuid'=>time().microtime(),
           ];
           $notificationEmail=$request->get('email');
           $resetuid=$data['resetuid'];
           User::where('email',$notificationEmail)->update(['email_verified_at'=>md5($resetuid)]);
           Mail::send("Reset.diaryResetChange",$data,function ($message) use ($notificationEmail) {
               $message->to($notificationEmail,"Kullanıcı")->subject("Diary Password Reset");
           });
           return view('Reset.diaryReset')->with('notificationEmail',$notificationEmail);
       }
       else{
           return back()->with('error','Wrong Email!Email not registered');
       }

   }
   public  function postResetConfirm(Request $request)
   {
       $this->validate($request, [
           'resetuid' => 'required',
           'password' => 'required|confirmed|alphaNum|min:6',

       ]);
       $password=$request->get('password');
       $password=Hash::make($password);
       $user_data = array(
           'resetuid' => $request->get('resetuid'),
           'password' => $password,

       );
       if (User::where('email_verified_at',md5($user_data['resetuid']))->first())
       {
           if(User::where('password',$user_data['password'])->first())
           {
               return back()->with('error','This is your previous password');
           }
           else
               {
           try {
               User::where('email_verified_at',md5($user_data['resetuid']))->update(['password' => $user_data['password']]);
               return back()->with('success','The password was changed')->with('loginAsk','Do you want to login? ');

           }
           catch (\Exception $e)
           {
               return back()->with('error','The password was not changed');
           }
               }
       }



   }

}
