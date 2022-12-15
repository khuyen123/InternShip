<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest as UserLoginRequest;
use App\Http\Requests\Users\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Logincontroller extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect('admin/home'); 
        } else{
        return view('Admin.User.login',[
            'title'=>"Trang đăng nhập"
        ]);
        }
    }
    public function store(UserLoginRequest $request)
    {
        if( Auth::attempt([
            'email' => $request ->input('email'),
            'password' =>$request ->input('password'),
        ],$request->input('remember'))) {
            if(Auth::user()->status == 1)
                return redirect()->route('home'); else{
                    Auth::logout();
                    Session::flash('error','Tài khoản chưa kích hoạt ');
                }

        }  else
            Session::flash('error','Tài khoản hoặc mật khẩu không chính xác ');
        return redirect()->back();
    }
   public function logout()
   {
        Auth::logout();
        return redirect('admin/user/login');
   }
}
