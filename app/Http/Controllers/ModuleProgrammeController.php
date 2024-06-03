<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleProgrammeController extends Controller
{

    public function destroy(Programme $programme,Module $module){
        $programme->modules()->detach($module);

        return back()->with('success','The module has been removed successfully!');
    }

    public function indexModules(Programme $programme){
        $modules=$programme->modules()->latest()->paginate(8);

        return view('programme.modules',['items'=>$modules,'parentItem'=>$programme]);

    }

    public function indexProgrammes(Module $module){
        $programmes=$module->programmes()->latest()->paginate(5);

        return view('module.programmes',['items'=>$programmes,'parentItem'=>$module]);
    }//End Action



    public function create(Programme $programme){

        $id=$programme->id;
        $modules = Module::where('institute_id',Auth()->guard('institute')->user()->id)->whereDoesntHave('programmes', function($query) use ($id) {

            $query->where('programme_id', $id);

        })->latest()->paginate(10);


        return view('programme.add-modules',['parentItem'=>$programme,'items'=>$modules]);
    }

    public function store(Request $request,Programme $programme){
        $data=$request->validate([
            'checked_ids'=>'required'
        ]);



        $programme->modules()->syncWithoutDetaching($data['checked_ids']);

        return back()->with('success','The modules were added to the programme successfully!');

    }
}
