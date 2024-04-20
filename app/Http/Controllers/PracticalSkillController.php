<?php

namespace App\Http\Controllers;

use App\Models\Practical;
use App\Models\Skill;
use Illuminate\Http\Request;

class PracticalSkillController extends Controller
{
    public function index(Practical $practical){
        $skills=$practical->skills()->latest()->paginate(5);

        return view('practical_skill.index',['items'=>$skills,'parentItem'=>$practical]);
    }


    public function indexPracticals(Skill $skill){

        $practicals=$skill->practicals()->latest()->paginate(5);

        return view('practical_skill.practicals',['items'=>$practicals,'parentItem'=>$skill]);
    }

    public function create(){
        return 'I am inside the create action of the PracticalSkillController';
    }

    public function destroy(Practical $practical,Skill $skill){
        $practical->skills()->detach($skill);

        return back()->with('success','The item has been removed successfully!');

    }
}
