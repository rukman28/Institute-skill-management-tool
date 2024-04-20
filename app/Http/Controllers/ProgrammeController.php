<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Rules\UniqueProgramme;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $programmes=Programme::where('institute_id',Auth::guard('institute')->user()->id)->latest()->paginate(8);

        return view('programme.index',['items'=>$programmes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('programme.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data=$request->validate([
            'name'=>[
                'required',
                function(string $attribute,mixed $value,Closure $fail){
                    if(Programme::where([
                        ['name',$value],
                         ['institute_id',Auth()->guard('institute')->user()->id]
                    ])->first()){
                        $fail("This name aleady exists..!");
                    }
                }
            ]
        ]);

        $programme=new Programme;

        $programme->create(['name'=>$data['name'],'institute_id'=>Auth()->guard('institute')->user()->id]);

        return redirect()->route('programmes.index')->with('success','Programme has been added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Programme $programme)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programme $programme)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programme $programme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programme $programme)
    {
        $programme->delete();
        return back()->with('success','Deleted successfully!');
    }
}
