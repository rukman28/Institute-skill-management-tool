<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index(){

        $modules=Module::where('institute_id',Auth::guard('institute')->user()->id)->latest()->paginate(8);

        return view('module.index',['items'=>$modules]);


    }

    public function destroy(Module $module){
        $module->delete();

        return back()->with('success','Deleted successfully!');

    }

    public function create(){
        return view('module.create');
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>[
                'required',
                function(string $attribute,mixed $value, Closure $fail){
                    if(Module::where([
                        ['name',$value],
                        ['institute_id',Auth()->guard('institute')->user()->id],
                    ])->first()){
                        $fail("This name already exists..!");
                    }
                }

                ]

        ]);

        $module=new Module;
        $module->create(['name'=>$data['name'],
        'institute_id'=>Auth()->guard('institute')->user()->id]);

        return redirect()->route('modules.index');
    }
}
