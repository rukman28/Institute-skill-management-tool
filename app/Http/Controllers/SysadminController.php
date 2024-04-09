<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SysadminController extends Controller
{
    public function index(){
        return view('sysadmin.login');
    }

    public function Dashboard(){
        return view('sysadmin.dashboard');
    }

    public function login(Request $request){
        $check=$request;
        if(Auth::guard('sysadmin')->attempt(['email'=>$check['email'],
        'password'=>$check['password']])){
            return redirect()->route('sysadmin.dashboard')->with('error','System Admin Logged in Successfully!');
        }else{

            return back()->with('error','Invalid Email Or Password');
        }
    }

    public function logout(){
        Auth::guard('sysadmin')->logout();
        return redirect()->route('landing')->with('error','System Admin logout successfully!');
    }


}
