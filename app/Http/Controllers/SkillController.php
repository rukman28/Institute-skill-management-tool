<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {

        $skills=Skill::where('institute_id',Auth::guard('institute')->user()->id)->latest()->paginate(8);

        return view('skill.index',['items'=>$skills]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success','Deleted successfully!');
    }

    public function create(){
        return view('skill.create');
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>[
                'required',
                function(string $attrigute,mixed $value, Closure $fail){
                    if(Skill::where([
                        ['name',$value],
                        ['institute_id',Auth()->guard('institute')->user()->id]
                    ])->first()){
                        $fail("This name already exists..!");
                    }
                }
            ]
        ]);

        $skill=new Skill;
        $skill->create(['name'=>$data['name'],
        'institute_id'=>Auth()->guard('institute')->user()->id]);

        return redirect()->route('skills.index')->with('success','The Skill added successfully..!');
    }


}
