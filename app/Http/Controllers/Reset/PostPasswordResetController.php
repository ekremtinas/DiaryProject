<?php

namespace App\Http\Controllers\Reset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
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



           $notificationEmail=$request->get('email');

           Mail::send("Reset.diaryResetChange",["email"=>"ekrem.tinas@gmail.com"],function ($message){
               $message->to("ekrem.tinas42@gmail.com","Kullanıcı")->subject("Diary Password Reset");
           });
           return view('Reset.diaryReset')->with('notificationEmail',$notificationEmail);
       }
       else{
           return back()->with('error','Wrong Email!Email not registered');
       }

   }
   /*public static function resetPasswordChange($request)
   {
       return view('Reset.diaryReset');
   }*/
}
