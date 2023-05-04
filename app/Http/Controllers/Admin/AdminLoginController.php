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
    public function AdminLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $credentials =[
          'email'=>$request->email,
          'password'=>$request->password,
        ];
        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login');
        }


    }
    public function Logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
