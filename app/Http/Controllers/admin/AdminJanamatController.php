<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Model\admin\AdminPosts;
use App\Model\admin\PublicOpinion;
use App\Model\site\UserAnswer;
use Illuminate\Http\Request;
use DB;

class AdminJanamatController extends Controller
{
    

    public function index(Request $request){
       
        $janamat_list= PublicOpinion::select('*')->get();
        return view('admin.janamat.list',compact('janamat_list'));

    }
    public function create()
    {
        $data=new \stdClass();
        $data->answers='';
        return view('admin.janamat.add',['data'=>$data,'id'=>null]);
    }

    public function edit($id){

        $data=DB::table('tbl_public_opinions')
                ->where('id',$id)
                ->first();  
        
        return view('admin.janamat.add',['data'=>$data,'id'=>$id]);
    }

    public function store(Request $request){

        $this->validate($request, [
            'answers.*' => 'required',
            'question'=>'required',
        ]);

        $answer=implode(',',$request->answers);

        $store_janamat = PublicOpinion::updateOrCreate(
        [
            'id'=> $request->id,
        ]
        ,[
            'answers'=>$answer,
            'question'=>$request->question

        ]);
        session()->flash('success', 'Janamat Created Successfully ');
        return redirect(route('janamat.index'));
    }

    public function destroy(Request $request){
        
    }

    public function viewUserAnswer(Request $request)
    {
        // $user_answer = 
        return view('admin.janamat.user_answer');

    }
}

   


