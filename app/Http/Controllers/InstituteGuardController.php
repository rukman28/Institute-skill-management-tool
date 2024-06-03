<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstituteGuardController extends Controller
{
    public function index(){
        // return view('institute.login_form');
        return redirect()->route('landing');
    }

    public function Dashboard(){
        $institute=Auth::guard('institute')->user();
        return view('institute.dashboard',['institute'=>$institute]);
    }


    public function login(Request $request){
       $check=$request;


        if(Auth::guard('institute')->attempt(['email' => $check['email'],
        'password' => $check['password']])){
                return redirect()->route('institutes.dashboard')->with('error','Institute logged in successfully!');
        }else{
            return back()->with('error','Invalid Email Or Password');
        }
    }

    public function logout(){
        Auth::guard('institute')->logout();
        return redirect()->route('landing')->with('error','System Admin logout successfully!');
    }


}
