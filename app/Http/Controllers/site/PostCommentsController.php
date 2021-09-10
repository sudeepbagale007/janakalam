<?php

namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;
use App\Model\site\PostComments;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function addPostComment(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email'=>'required',
            'comment'=>'required',
        ]);

        $comment = new PostComments;
        $comment->name=$request->name;
        $comment->email=$request->email;
        $comment->comment=$request->comment;
        $comment->post_id=$request->post_id;
        $comment->save();
        session()->flash('comment', 'तपइको अमूल्य प्रतिक्रिया  को लागी धन्याबाद');
        return back();

    }
}
