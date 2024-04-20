<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Programme;
use Illuminate\Http\Request;

class ModuleProgrammeController extends Controller
{

    public function destroy(Programme $programme,Module $module){
        $programme->modules()->detach($module);

        return back()->with('success','The module has been removed successfully!');
    }

    public function indexModules(Programme $programme){
        $modules=$programme->modules()->latest()->paginate(4);

        return view('module_programme.modules',['items'=>$modules,'parentItem'=>$programme]);

    }

    public function indexProgrammes(Module $module){
        $programmes=$module->programmes()->latest()->paginate(5);

        return view('module_programme.programmes',['items'=>$programmes,'parentItem'=>$module]);
    }
}
