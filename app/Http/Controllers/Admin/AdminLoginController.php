<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AdminLoginController extends Controller
{
    public function index(){

        return view('admin.login');
    }
    public function ForgetPage(){
        return view('admin.forget_password');
    }
}
