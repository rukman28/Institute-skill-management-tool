<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Skillcategory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {

        $skills=Skill::where('institute_id',Auth::guard('institute')->user()->id)->latest()->paginate(8);

        return view('skill.index',['items'=>$skills]);
    }//END ACTION

    public function destroy(Skill $skill)
    {
        if($skill->practicals()->count()){
            return back()->with('warning','The skill contains practicals!');
        }
        else{

            $skill->delete();
            return back()->with('success','The Skill has been deleted successfully!');
        }
    }//END ACTION

    public function create(){
        $skillCategories=Skillcategory::where('institute_id',Auth()->guard('institute')->user()->id)->get();

        return view('skill.create',compact('skillCategories'));
    }//END ACTION

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
            ],
            'skillcategory'=>['required']
        ]);

        $skill=new Skill;
        $skill->create(['name'=>$data['name'],'skillcategory_id'=>$data['skillcategory'],
        'institute_id'=>Auth()->guard('institute')->user()->id]);

        return redirect()->route('skills.index')->with('success','The Skill added successfully..!');
    }//END ACTION


    public function show(Skill $skill){

        $practicals=$skill->practicals()->paginate();

        return view('skill.practicals',['items'=>$practicals,'parentItem'=>$skill]);
    }//End Action


    public function indexSkillcategory(Skill $skill){
        $skillcategories=$skill->skillcategory()->paginate(1);

        return view('skill.skillcategory',['items'=>$skillcategories,'parentItem'=>$skill]);
    }


}
