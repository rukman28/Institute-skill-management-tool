<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Practical;
use Illuminate\Http\Request;

class ModulePracticalController extends Controller
{
    public function indexPracticals(Module $module){
        $practicals=$module->practicals()->latest()->paginate(8);
        return view('module.practicals',['items'=>$practicals,'parentItem'=>$module]);
    }

    public function indexModules(Practical $practical){
        $modules=$practical->modules()->latest()->paginate(8);
        return view('practical.modules',['items'=>$modules,'parentItem'=>$practical]);
    }

    public function destroy(Module $module,Practical $practical){
        $module->practicals()->detach($practical);

        return back()->with('success','The practical has been removed successfully!');

    }

    public function create(Module $module){

        $id=$module->id;
        $practicals = Practical::where('institute_id',Auth()->guard('institute')->user()->id)->whereDoesntHave('modules', function($query) use ($id) {

            $query->where('module_id', $id);

        })->latest()->paginate(10);


        return view('module.add-practicals',['parentItem'=>$module,'items'=>$practicals]);
    }

    public function store(Request $request,Module $module){
        $data=$request->validate([
            'checked_ids'=>'required'
        ]);

        $module->practicals()->syncWithoutDetaching($data['checked_ids']);

        return back()->with('errors','The practicals were added to the module successfully!');


    }


}
