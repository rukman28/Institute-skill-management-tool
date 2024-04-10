<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function index()
    {

        $skills=Skill::where('institute_id',Auth::guard('institute')->user()->id)->paginate(10);

        return view('skill.index',['items'=>$skills]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success','Deleted successfully!');
    }


}
