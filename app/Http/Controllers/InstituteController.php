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
        return view('institute.index',['institutes'=>Institute::latest('updated_at')->paginate(8)]);
    }//END METHOD

    public function create()
    {
        return view('institute.create');
    }//END METHOD

    public function store(UserCreateRequest $request)
    {
        // dd('I am here');
        // Institute::create($request->validated());
        // if(Auth::guard('sysadmin')->check()){
        //     return redirect()->route('sysadmin.institutes.index');
        // }elseif(Auth::guard('institute')->check()){
        //     return redirect()->route('institutes.index');

        // }

        Institute::create($request->validated());
        return redirect()->route('sysadmin.institutes.index');

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
            return redirect()->route('sysadmin.institutes.index')->with('success','The address has been changed successfully!');

        }elseif(Auth::guard('institute')->check()){

            return redirect()->route('institutes.dashboard')->with('success','The address has been changed successfully!');
        }
    }//END METHOD


    public function destroy(Institute $institute)
    {
        $programmes=$institute->programmes;
        foreach($programmes as $programme){
            $programme->modules()->sync([]);
        }

        $modules=$institute->modules;
        foreach($modules as $module){
            $module->practicals()->sync([]);
        }

        $practicals=$institute->practicals;
        foreach($practicals as $practical){
            $practical->skills()->sync([]);
        }

        $institute->delete();
        return back()->with('success','The Institute has been deleted successfully!');
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
