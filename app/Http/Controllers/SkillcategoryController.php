<?php

namespace App\Http\Controllers;

use App\Models\Skillcategory;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillcategoryController extends Controller
{
    public function index(){

        $modules=Skillcategory::where('institute_id',Auth::guard('institute')->user()->id)->latest()->paginate(8);

        return view('skillcategory.index',['items'=>$modules]);


    }

    public function destroy(Skillcategory $skillcategory)
    {
        $skillcategory->delete();
        return back()->with('success','Deleted successfully!');
    }

    public function create(){
        return view('skillcategory.create');
    }

    public function show(Skillcategory $skillcategory){
            $skills=$skillcategory->skills()->paginate(5);
            return view('skillcategory.skills',['items'=>$skills]);
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>[
                'required',
                function(string $attribute,mixed $value, Closure $fail){
                    if(Skillcategory::where([
                        ['name',$value],
                        ['institute_id',Auth()->guard('institute')->user()->id],
                    ])->first()){
                        $fail("This name already exists..!");
                    }
                }
            ]
        ]);

        $skillcategory=new Skillcategory;
        $skillcategory->create([
            'name'=>$data['name'],
            'institute_id'=> Auth()->guard('institute')->user()->id,
        ]);


        return redirect()->route('skillcategories.index')->with('success','The Skillcategory added successfully..!');
    }


}
