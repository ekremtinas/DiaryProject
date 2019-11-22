<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetProfileController extends Controller
{
    public function index()
    {
        return view('Profile.userProfile');
    }
}
