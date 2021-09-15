<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Model\admin\PublicOpinion;
use DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AdminPostsCommentsController extends Controller
{
    public function index(FacadesRequest $request){
       
        $post_comments = DB::table('tbl_post_comments')->select('*')->get();
        return view('admin.comments.postcomments',compact('post_comments'));

    }
}
