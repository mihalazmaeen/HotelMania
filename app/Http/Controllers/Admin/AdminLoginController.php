<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function ForgetPage(){
        return view('admin.forget_password');
    }
}
