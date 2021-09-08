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

    public function viewUserAnswer(Request $request,$id)
    {

        $janamat = PublicOpinion::select('id','question','answers')->where('id',$request->id)->first();

        $user_answers = PublicOpinion::select('*')
        ->leftJoin('tbl_users_opinions','tbl_users_opinions.janamat_id','tbl_public_opinions.id')
        ->where('tbl_users_opinions.janamat_id',$request->id)
        ->get();

        $selected_answer=DB::table('tbl_users_opinions')
        ->where('janamat_id',$janamat->id)
        ->select('selected_answer', DB::raw('count(*) as total'))
        ->groupBy('selected_answer')
        ->get();  

        return view('admin.janamat.user_answer',compact('user_answers','janamat','selected_answer'));

    }
}

   


