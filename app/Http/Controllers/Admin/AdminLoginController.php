<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\websitemail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


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
    public function AdminResetPassword(Request $request){
        $request->validate([
            'email'=>'required|email',

        ]);
        $admin_mail=Admin::where('email',$request->email)->first();
        if(!$admin_mail){
            return redirect()->back()->with('error','Email does not match');
        }else{
            $token=hash('sha256',time());
            $admin_mail->token=$token;
            $admin_mail->update();
            $reset_link=url('admin/reset-password/'.$token.'/'.$request->email);
            $subject='Reset Password';
            $message='Please click the following link <br>';
            $message .= '<a href="'.$reset_link.'">Click Here</a>';
            Mail::to($request->email)->send(new websitemail($subject, $message));
            return redirect()->route('admin.login')->with('success','Please follow the instructions sent to your mail');
        }
    }
    public function AdminNewPassword($token,$email){
        $admin_reset=Admin::where('token',$token)->where('email',$email)->first();
        if(!$admin_reset){
            return redirect()->route('admin.login');
        }
        return view('admin.layout.reset_password',compact('token','email'));
    }
    public function Logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function AdminCreateNewPassword(Request $request){
        $request->validate([
            'password' =>'required',
            'retype_password'=>'required|same:password',
        ]);
        $admin_data=Admin::where('token',$request->token)->where('email',$request->email)->first();
        $admin_data->password=Hash::make($request->password);
        $admin_data->token='';
        $admin_data->update();
        return redirect()->route('admin.login');



    }
}
