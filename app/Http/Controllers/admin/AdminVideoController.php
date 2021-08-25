<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PrintHelper;

class AdminVideoController extends Controller {

    private $title = 'Video';
    private $sort_by = 'published_date';
    private $sort_order = 'asc';
    private $index_link = 'video.index';
    private $list_page = 'admin.video.list';
    private $create_form = 'admin.video.add';
    private $update_form = 'admin.video.edit';
    private $link = 'video';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AdminVideo::orderBy($this->sort_by, $this->sort_order)->paginate(PAGES);
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
        $result = array(
            'page_header'       => 'Add '.$this->title.' Detail',
            'link'              => $this->link,
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
            'youtube_url'        => 'required',
        ]);
        $crud = new AdminVideo;
        $crud->title = $request->title;
        $crud->youtube_url=preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","$1",$request->youtube_url);
        // $crud->image = chunkfullurl($request->image);
        $crud->image = $request->image;
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
        $record = AdminVideo::findOrFail($id);
        $result = array(
            'page_header'       => 'Edit '.$this->title.' Detail',
            'record'            => $record,
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
            'youtube_url'        => 'required',
        ]);
        $crud = AdminVideo::findOrFail($id);
        $crud->title = $request->title;
        $crud->youtube_url=preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","$1",$request->youtube_url);
        // $crud->image = chunkfullurl($request->image);
        $crud->image = $request->image;
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
        $crud = AdminVideo::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}