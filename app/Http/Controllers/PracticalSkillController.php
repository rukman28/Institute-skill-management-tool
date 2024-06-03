<?php

namespace App\Http\Controllers;

use App\Models\Practical;
use App\Models\Skill;
use Illuminate\Http\Request;

class PracticalSkillController extends Controller
{
    public function index(Practical $practical){
        $skills=$practical->skills()->latest()->paginate(8);

        return view('practical.skills',['items'=>$skills,'parentItem'=>$practical]);
    }


    public function indexPracticals(Skill $skill){

        $practicals=$skill->practicals()->latest()->paginate(8);

        return view('skill.practicals',['items'=>$practicals,'parentItem'=>$skill]);
    }


    public function destroy(Practical $practical,Skill $skill){
        $practical->skills()->detach($skill);

        return back()->with('success','The item has been removed successfully!');

    }

    public function create(Practical $practical){

        $id=$practical->id;
        $skills = Skill::where('institute_id',Auth()->guard('institute')->user()->id)->whereDoesntHave('practicals', function($query) use ($id) {

            $query->where('practical_id', $id);

        })->latest()->paginate(10);


        return view('practical.add-skills',['parentItem'=>$practical,'items'=>$skills]);
    }


    public function store(Practical $practical,Request $request){

        $data=$request->validate([
            'checked_ids'=>'required'
        ]);

        $practical->skills()->syncWithoutDetaching($data['checked_ids']);

        return back()->with('success','The skills were added to the practical successfully!');

    }




}
