<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetRegisterController extends Controller
{
    public function index()
    {
        return view('Register.diaryRegister');
    }
}
