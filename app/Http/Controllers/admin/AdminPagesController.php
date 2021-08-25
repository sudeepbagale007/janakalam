<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminPages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPagesController extends Controller {

    private $title = 'Pages';
    private $sort_by = 'title';
    private $sort_order = 'asc';
    private $index_link = 'pages.index';
    private $list_page = 'admin.pages.list';
    private $create_form = 'admin.pages.add';
    private $update_form = 'admin.pages.edit';
    private $link = 'pages';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AdminPages::orderBy($this->sort_by, $this->sort_order)->get();
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
            'description'        => 'required',
        ]);

        $user_id = AdminLoginController::id();
        
        $crud = new AdminPages;
        $crud->title = $request->title;
        $crud->description = $request->description;
        $crud->image = chunkfullurl($request->image);
        $crud->published_date = date('Y-m-d');
        $crud->fb_image = chunkfullurl($request->fb_image);
        $crud->show_homepage = 1; //$request->show_homepage;
        $crud->viewcount = 1;
        $crud->created_by = $user_id;
        $crud->meta_keywords = $request->meta_keywords;
        $crud->meta_description = $request->meta_description;
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
        $record = AdminPages::findOrFail($id);
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
        // return $request->all();
        $this->validate($request, [
            'title'              => 'required',
            'description'        => 'required',
        ]);

        $user_id = AdminLoginController::id();
        $crud = AdminPages::findOrFail($id);
        $crud->title = $request->title;
        $crud->description = $request->description;
        $crud->image = chunkfullurl($request->image);
        $crud->fb_image = chunkfullurl($request->fb_image);
        $crud->published_date = $request->published_date;
        $crud->show_homepage = 1; //$request->show_homepage;
        $crud->slug = str_slug($request->slug, '-');
        $crud->updated_by = $user_id;
        $crud->meta_keywords = $request->meta_keywords;
        $crud->meta_description = $request->meta_description;
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
        $crud = AdminPages::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}