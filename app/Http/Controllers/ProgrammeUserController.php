<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgrammeUserController extends Controller
{
    public function find_user_create(){
        return view('institute.find_user_form');
    }

    public function find_user(Request $request){

        $request->validate([
            'email'=> 'required',
            'code'=> 'required'
        ]);

    $user=User::where([
        ['email','=',$request->email],
        ['code','=',$request->code],
    ])->first();


    if($user){

        $id=$user->id;
        $programmes=Programme::where('institute_id',Auth()->guard('institute')->user()->id)->whereDoesntHave('users', function($query) use ($id) {

            $query->where('user_id', $id);

        })->latest()->paginate(10);


       return view('Institute.assign_programmes_to_user',['parentItem'=>$user,'items'=>$programmes]);

    }else{
        return back()->with('warning','User does not exist!');
    }

    }


    public function store(Request $request,User $user ){

        $data=$request->validate([
            'checked_ids'=>'required'
        ]);
        dd('I am here ');

    }
}
