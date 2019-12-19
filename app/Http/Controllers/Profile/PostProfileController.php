<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostProfileController extends Controller
{
    public function index(Request $request)
    {

        $this->validate($request, [
            'id' => 'required',
            'email' => 'required|email',

            'name' => 'required',
            'country' => 'required',
            'lang' => 'required',
        ]);


        $user_data = array(
            'id' => $request->get('id'),
            'email' => $request->get('email'),

            'name' => $request->get('name'),
            'country' => $request->get('country'),
            'lang' => $request->get('lang'),
        );
        try {
            User::where('id',$user_data['id'])->update($user_data);

            return back()->with('success','User Updated');
        }
        catch (\Exception $exception)
        {
            return back()->withInput()->with('error','User not updated');
        }
    }
}
