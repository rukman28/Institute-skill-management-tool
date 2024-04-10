<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index(){

        $modules=Module::where('institute_id',Auth::guard('institute')->user()->id)->paginate(10);

        return view('module.index',['items'=>$modules]);


    }

    public function destroy(Module $module){
        $module->delete();

        return back()->with('success','Deleted successfully!');

    }
}
