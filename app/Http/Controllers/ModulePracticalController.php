<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Practical;
use Illuminate\Http\Request;

class ModulePracticalController extends Controller
{
    public function indexPracticals(Module $module){
        $practicals=$module->practicals()->latest()->paginate(4);
        return view('module.practicals',['items'=>$practicals,'parentItem'=>$module]);
    }

    public function indexModules(Practical $practical){
        $modules=$practical->modules()->latest()->paginate(5);
        return view('practical.modules',['items'=>$modules,'parentItem'=>$practical]);
    }

    public function destroy(Module $module,Practical $practical){
        $module->practicals()->detach($practical);

        return back()->with('success','The practical has been removed successfully!');

    }
}
