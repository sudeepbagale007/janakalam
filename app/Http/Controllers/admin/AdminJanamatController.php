<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Model\admin\AdminPosts;
use App\Model\admin\PublicOpinion;

use Illuminate\Http\Request;

class AdminJanamatController extends Controller
{
    

    public function index(Request $request){
       
        $janamat_list= PublicOpinion::select('*')->get();
        return view('admin.janamat.list',compact('janamat_list'));

    }
    public function create()
    {
        return view('admin.janamat.add');

    }

    public function store(Request $request){

        $this->validate($request, [
            'answers' => 'required',
            'question'=>'required',
        ]);
        $store_janamat = PublicOpinion::updateOrCreate(
        [
            'id'=> $request->id,
        ]
        ,[
            'answers'=>$request->answers,
            'question'=>$request->question

        ]);
        session()->flash('success', 'Janamat Created   Successfully ');
        return redirect(route('janamat.index'));
    }


    public function destroy(Request $request){
        
    }
}

   


