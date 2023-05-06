<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard')->middleware('admin:admin');
Route::get('/admin/login',[AdminLoginController::class,'index'])->name('admin.login');
Route::get('/admin/logout',[AdminLoginController::class,'Logout'])->name('admin.logout');
Route::post('/admin/login_submit',[AdminLoginController::class,'AdminLogin'])->name('admin.login.submit');
Route::post('/admin/reset/password/',[AdminLoginController::class,'AdminResetPassword'])->name('admin.reset.password');
Route::post('/admin/new/password/',[AdminLoginController::class,'AdminCreateNewPassword'])->name('admin.submit.new.password');
Route::get('/admin/reset-password/{token}/{email}',[AdminLoginController::class,'AdminNewPassword'])->name('admin.new.password');
Route::get('/admin/forget_password',[AdminLoginController::class,'ForgetPage'])->name('admin.forgetPassword');
