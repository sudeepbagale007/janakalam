<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminVideoType;
use App\Model\admin\AdminVideoPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PrintHelper;

class AdminVideoPostController extends Controller {

    private $title = 'Video Post';
    private $sort_by = 'published_date';
    private $sort_order = 'asc';
    private $index_link = 'video-post.index';
    private $list_page = 'admin.video-post.list';
    private $create_form = 'admin.video-post.add';
    private $update_form = 'admin.video-post.edit';
    private $link = 'video-post';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AdminVideoPost::orderBy($this->sort_by, $this->sort_order)->paginate(PAGES);
        $result = array(
            'list'              => $list,
            'page_header'       => 'List of '.$this->title,
            'link'              => $this->link,
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
        $type=AdminVideoType::where('status','1')->get();
        $result = array(
            'page_header'       => 'Add '.$this->title.' Detail',
            'link'              => $this->link,
            'type'              => $type,
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
            'title'              => 'required',
            'video_url'        => 'required',
        ]);
        $crud = new AdminVideoPost;
        $crud->title = $request->title;
        $crud->video_url = $request->video_url;
        $crud->video_type_id = $request->video_type_id;
        $crud->show_on_homepage = $request->show_on_homepage;
        $crud->published_date = date('Y-m-d');
        $crud->status = $request->status;
        $crud->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = AdminVideoPost::findOrFail($id);
        $type=AdminVideoType::where('status','1')->get();
        $result = array(
            'page_header'       => 'Edit '.$this->title.' Detail',
            'record'            => $record,
            'type'              => $type,
            'link'              => $this->link,
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
            'title'              => 'required',
            'video_url'        => 'required',
        ]);
        $crud = AdminVideoPost::findOrFail($id);
        $crud->title = $request->title;
        $crud->video_url = $request->video_url;
        $crud->video_type_id = $request->video_type_id;
        $crud->show_on_homepage = $request->show_on_homepage;
        $crud->published_date = $request->published_date;
        $crud->status = $request->status;
        $crud->save();

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
        $crud = AdminVideoPost::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}