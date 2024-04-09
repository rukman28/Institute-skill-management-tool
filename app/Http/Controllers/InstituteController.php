<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressUpdate;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserPasswordUpdate;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstituteController extends Controller
{
    public function index()
    {
        return view('institute.index',['institutes'=>Institute::latest()->paginate(8)]);
    }//END METHOD

    public function create()
    {
        return view('institute.create');
    }//END METHOD

    public function store(UserCreateRequest $request)
    {
        Institute::create($request->validated());
        if(Auth::guard('sysadmin')->check()){
            return redirect()->route('sysadmin.institutes.index');
        }elseif(Auth::guard('institute')->check()){
            return redirect()->route('institutes.index');

        }

    }//END METHOD

    public function show(Institute $institute)
    {

        return view('institute.show',['institute'=>$institute]);
    }//END METHOD

    public function edit(Institute $institute)
    {
            return view('institute.edit',['institute'=>$institute]);

    }//END METHOD

    public function update(UserAddressUpdate $request, Institute $institute)
    {
        $institute->update($request->validated());

        if(Auth::guard('sysadmin')->check()){
            return redirect()->route('sysadmin.institutes.index');

        }elseif(Auth::guard('institute')->check()){

            return redirect()->route('institutes.dashboard');
        }
    }//END METHOD


    public function destroy(Institute $institute)
    {
        $institute->delete();
        return back()->with('success','Item has been deleted successfully!');
    }//END METHOD


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function password_change_create(Institute $institute){
        return view('institute.password_change',['institute'=>$institute]);
    }//END METHOD


    public function password_change(UserPasswordUpdate $request,Institute $institute){

        $data=$request->validated();
        $institute->password=Hash::make($data['password']);
        $institute->save();

        if(Auth::guard('sysadmin')->check()){
            return redirect()->route('sysadmin.institutes.edit',$institute)->with('success','The Password has been changed!');

        }elseif(Auth::guard('institute')->check()){
            return redirect()->route('institutes.edit',$institute)->with('success','The Password has been changed!');

        }
    }//END METHOD



    public function email_change_create(Institute $institute){
        return view('institute.email_change',['institute'=>$institute]);
    }//END METHOD


    public function email_change(Request $request,Institute $institute){

        $data=$request->validate([
            'email'=>'required|email|unique:institutes,email',

        ]);

        $institute->update($data);
        if(Auth::guard('sysadmin')->check()){
            return redirect()->route('sysadmin.institutes.edit',$institute)->with('success','The Email has been changed!');

        }elseif(Auth::guard('institute')->check()){
            return redirect()->route('institutes.edit',$institute)->with('success','The Email has been changed!');

        }


    }//END METHOD


}
