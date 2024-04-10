<?php

namespace App\Http\Controllers;

use App\Models\Skillcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillcategoryController extends Controller
{
    public function index(){

        $modules=Skillcategory::where('institute_id',Auth::guard('institute')->user()->id)->paginate(10);

        return view('skillcategory.index',['items'=>$modules]);


    }

    public function destroy(Skillcategory $skillcategory)
    {
        $skillcategory->delete();
        return back()->with('success','Deleted successfully!');
    }


}
