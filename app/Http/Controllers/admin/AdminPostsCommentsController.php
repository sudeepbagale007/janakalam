<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Model\admin\PublicOpinion;
use DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AdminPostsCommentsController extends Controller
{
    public function index(FacadesRequest $request){
       
        $post_comments = DB::table('tbl_post_comments')
        ->select('*','tbl_post_comments.created_at as c_date')
        ->leftJoin('tbl_posts','tbl_post_comments.post_id','tbl_posts.id')
        ->get();
        return view('admin.comments.postcomments',compact('post_comments'));

    }
}
