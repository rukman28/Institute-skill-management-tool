<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class InstituteGuardController extends Controller
{
    public function index()
    {
        // return view('institute.login_form');
        return redirect()->route('landing');
    }

    public function Dashboard()
    {
        $institute = Auth::guard('institute')->user();
        return view('institute.dashboard', ['institute' => $institute]);
    }


    public function login(Request $request)
    {
        $check = $request->validate([
            'emailAdmin' => 'required|email',
            'passwordAdmin' => 'required'
        ]);;


        if (Auth::guard('institute')->attempt([
            'email' => $check['emailAdmin'],
            'password' => $check['passwordAdmin']
        ])) {
            return redirect()->route('institutes.dashboard')->with('error', 'Institute logged in successfully!');
        } else {

            /*
            **The throw validatinException function is used to call the auth.failed built in error message.
            **
            */
            throw ValidationException::withMessages([
                'emailAdmin' => trans('auth.failed'),
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('institute')->logout();
        return redirect()->route('landing')->with('error', 'System Admin logout successfully!');
    }
}
