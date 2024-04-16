<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Practical;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticalController extends Controller
{
    public function index(){

        $practicals=Practical::where('institute_id',Auth::guard('institute')->user()->id)->latest()->paginate(8);

        return view('practical.index',['items'=>$practicals]);


    }

    public function destroy(Practical $practical){
        $practical->delete();

        return back()->with('success','Deleted successfully!');

    }

    public function create(){
        return view('practical.create');
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>[
                'required',
                function(string $attribute,mixed $value, Closure $fail){
                    if(Practical::where([
                        ['name',$value],
                        ['institute_id',Auth()->guard('institute')->user()->id],
                    ])->first()){
                        $fail("This name already exists..!");
                    }
                }
            ]
        ]);

        $practical=new Practical;
        $practical->create(['name'=>$data['name'],
        'institute_id'=>Auth()->guard('institute')->user()->id]);

        return redirect()->route('practicals.index')->with('success','The practical added successfully!');
    }

}
