<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminCategory;
use App\Model\admin\AdminCompanyList;
use App\Model\admin\AdminPosts;
use App\Model\admin\AdminTag;
use App\Model\admin\AdminSector;
use App\Model\admin\AdminAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller {

    private $title = 'Posts';
    private $sort_by = 'id';
    private $sort_order = 'asc';
    private $index_link = 'posts.index';
    private $list_page = 'admin.posts.list';
    private $create_form = 'admin.posts.add';
    private $update_form = 'admin.posts.edit';
    private $link = 'posts';
    private $categorylist;
    private $authorlist;
    private $taglist;
    private $sectorlist;
    private $companylist;

    public function __construct(){
        $this->categorylist = AdminCategory::where('parent_id',0)
                                // ->where('status',1)
                                ->select('id','title')
                                ->orderBy('title', 'desc')
                                ->get();

        $this->authorlist = AdminAuthor::select('id','name')
                                ->orderBy('name', 'asc')
                                ->get();

        $this->taglist = AdminTag::select('id','title')
                                ->orderBy('title', 'asc')
                                ->get();


        if (!empty($this->categorylist)) {
            foreach ($this->categorylist as $k => $val) {
                $childlist = AdminCategory::where('parent_id',$val->id)
                                ->select('id','title')
                                ->orderBy('title', 'asc')
                                ->get();
                $this->categorylist[$k]->childlist = $childlist;
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($_GET)) {
            $title = $request->input('title');
            $category = $request->input('category');
            $date = $request->input('published_date');
            // $list = AdminPosts::getFilterDataSearch($title,$date);
            $query = AdminPosts::with('category');
            if ($title != '') {
                $query->where('title', 'like', '%' . $title . '%');
            }
            if ($date != '') {
                $query->whereDate('published_date', $date);
            }
            if ($category != '') {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('category_id', $category);
                });
            }
            $list = $query->select('id', 'title', 'slug', 'published_date', 'status','viewcount','show_image','created_by','updated_by','created_at')
                ->orderBy('created_at', 'desc')
                ->paginate(PAGES);
        } else {
            $list = AdminPosts::with('category')
                ->select('id', 'title', 'slug', 'published_date', 'status','viewcount','show_image','created_by','updated_by')
                ->orderBy($this->sort_by, $this->sort_order)
                ->paginate(PAGES);
        }
        $result = array(
            'categorylist'      => $this->categorylist,
            'authorlist'        => $this->authorlist,
            'list'              => $list,
            'link'              => $this->link,
            'page_header'       => 'List of '.$this->title,
        );
        return view($this->list_page, $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return $this->categorylist;
        $result = array(
            'categorylist'      => $this->categorylist,
            'authorlist'        => $this->authorlist,
            'taglist'           => $this->taglist,
            'companylist'       => $this->companylist,
            'sectorlist'        => $this->sectorlist,
            'link'              => $this->link,
            'page_header'       => 'Add '.$this->title.' Detail',
        );
        return view($this->create_form, $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'             => 'required',
            'description'       => 'required',
            'category'          => 'required',
        ]);
        $user_id = AdminLoginController::id();
        if($request->status==0){
                $published_date = null;
        }
        else{   
            $published_date = $request->published_date;
        }

        $crud = new AdminPosts;
        $crud->title = $request->title;
        $crud->short_text = $request->short_text;
        $crud->sub_heading = $request->sub_heading;
        $crud->description = $request->description;
        // $crud->image = chunkfullurl($request->image);
        // $crud->fb_image = chunkfullurl($request->fb_image);
        $crud->image = $request->image;
        $crud->fb_image = $request->fb_image;
        $crud->published_date = $published_date;
        // $crud->slug = postSlug($request->title);
        $crud->breaking_news = $request->breaking_news;
        $crud->stick_news = $request->stick_news;

        $crud->show_image = $request->show_image;
        $crud->interviewer_name = $request->interviewer_name;
        $crud->author_name = $request->author_name;
        $crud->author_id = $request->author_id;
        $crud->video_url = $request->video_url;
        $crud->viewcount = 1;
        $crud->created_by = $user_id;
        $crud->meta_keywords = $request->meta_keywords;
        $crud->meta_description = $request->meta_description;
        $crud->status = $request->status;
        $crud->save();
        if($crud){
            $slugValue=AdminPosts::find($crud->id);
            $ran=rand(10,100);
            $slugValue->slug=time().'-'.$slugValue->slug.'-'.$ran;
            $slugValue->save();
        }

        // if($crud){
        //     $slugValue=AdminPosts::find($crud->id);
        //     $ran=rand(10,100);
        //     $slugValue->slug=date('Y').'-'.date('m').'-'.date('d').'-'.$crud->id;
        //     $slugValue->save();
        // }
        $crud->category()->sync($request->category);
        

        if (!empty($request->tag)) {
            DB::table('rel_post_tag')->where('post_id', $crud->id)->delete();
            foreach ($request->tag as $val) {
                $val = strtolower($val);
                $checkdata = AdminTag::where('title',$val)->first();
                if (!empty($checkdata)) {
                    # exists
                    $tagid = $checkdata->id;
                }else{
                    // insert new
                    $tag = new AdminTag;
                    $tag->slug = str_slug($val);
                    $tag->title = $val;
                    $tag->status = 1;
                    $tag->save();

                    $tagid = $tag->id;
                }

                DB::table('rel_post_tag')->insert([
                    'post_id' => $crud->id,
                    'tag_id' => $tagid
                ]);
            }
        }

        Session::flash('success_message', CREATED);
        return redirect(route($this->index_link));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route($this->index_link));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = AdminPosts::with('category')->where('id',$id)->first();
        $result = array(
            'page_header'       => 'Edit '.$this->title.' Detail',
            'record'            => $record,
            'link'              => $this->link,
            'categorylist'      => $this->categorylist,
            'authorlist'        => $this->authorlist,
            'taglist'           => $this->taglist,
            'companylist'       => $this->companylist,
            'sectorlist'        => $this->sectorlist,
        );
        return view($this->update_form, $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title'             => 'required',
            'slug'              => 'required',
            'description'       => 'required',
        ]);

        // dd($request->published_date);
        if($request->status==1){
            if($request->published_date == null){
                $published_date = date('Y-m-d H:i');
            }
            else{
                $published_date = $request->published_date;
            }
        }
        else{   
            $published_date = $request->published_date;
        }

        $user_id = AdminLoginController::id();
        $crud = AdminPosts::findOrFail($id);
        $crud->title = $request->title;
        $crud->short_text = $request->short_text;
        $crud->sub_heading = $request->sub_heading;
        $crud->description = $request->description;
        $crud->slug = str_slug($request->slug, '-');
        // $crud->image = chunkfullurl($request->image);
        // $crud->fb_image = chunkfullurl($request->fb_image);
        $crud->image = $request->image;
        $crud->fb_image = $request->fb_image;
        $crud->published_date = $published_date;
        $crud->breaking_news = $request->breaking_news;
        $crud->stick_news = $request->stick_news;

        $crud->show_image = $request->show_image;
        $crud->interviewer_name = $request->interviewer_name;
        $crud->author_name = $request->author_name;
        $crud->author_id = $request->author_id;
        $crud->video_url = $request->video_url;
        $crud->updated_by = $user_id;
        $crud->meta_keywords = $request->meta_keywords;
        $crud->meta_description = $request->meta_description;
        $crud->status = $request->status;
        $crud->save();
        $crud->category()->sync($request->category);
        //$crud->sector()->sync($request->sector);
        //$crud->company()->sync($request->companyid);

        if (!empty($request->tag)) {
            DB::table('rel_post_tag')->where('post_id', $crud->id)->delete();
            foreach ($request->tag as $val) {
                $val = strtolower($val);
                $checkdata = AdminTag::where('title',$val)->first();
                if (!empty($checkdata)) {
                    # exists
                    $tagid = $checkdata->id;
                }else{
                    // insert new
                    $tag = new AdminTag;
                    $tag->slug = str_slug($val);
                    $tag->title = $val;
                    $tag->status = 1;
                    $tag->save();

                    $tagid = $tag->id;
                }

                DB::table('rel_post_tag')->insert([
                    'post_id' => $crud->id,
                    'tag_id' => $tagid
                ]);
            }
        }
        
        Session::flash('success_message', UPDATED);
        return redirect(route($this->index_link));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crud = AdminPosts::findOrFail($id);
        $crud->delete();
        AdminPosts::deletePostsCategoryList($id);
        //AdminPosts::deletePostsSectorList($id);
        AdminPosts::deletePostsTagsList($id);
        //AdminPosts::deletePostsCompanyList($id);
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }


    // public function migrateData(){
    //     $list = AdminPosts::select('id','image')->get();
    //     foreach ($list as $kl => $val) {
    //         $data = AdminPosts::findOrFail($val->id);
    //         $data->image = 'uploads/source/2018/uploads/'.$val->image;
    //         $data->save();

    //         echo $val->id.' <---> done';
    //     }
    //     return 'final done';
    // }
}