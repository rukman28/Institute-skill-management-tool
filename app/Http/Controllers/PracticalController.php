<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Practical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticalController extends Controller
{
    public function index(){

        $practicals=Practical::where('institute_id',Auth::guard('institute')->user()->id)->paginate(10);

        return view('practical.index',['items'=>$practicals]);


    }

    public function destroy(Practical $practical){
        $practical->delete();

        return back()->with('success','Deleted successfully!');

    }

}
