<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\AdminTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminTagController extends Controller {

    private $title = 'Tags';
    private $sort_by = 'title';
    private $sort_order = 'asc';
    private $index_link = 'tag.index';
    private $list_page = 'admin.tag.add';
    private $create_form = 'admin.tag.add';
    private $update_form = 'admin.tag.edit';
    private $link = 'tag';
    private $list;

    public function __construct(){
        $this->list = AdminTag::orderBy($this->sort_by, $this->sort_order)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = array(
            'list'              => $this->list,
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
        return redirect(route($this->index_link));
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
        ]);
        $crud = new AdminTag;
        $crud->title = $request->title;
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
        $record = AdminTag::findOrFail($id);
        $result = array(
            'list'              => $this->list,
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
            'title'       => 'required',
            'slug'        => 'required',
        ]);
        $crud = AdminTag::findOrFail($id);
        $crud->title = $request->title;
        $crud->slug = str_slug($request->slug,'-');
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
        $crud = AdminTag::findOrFail($id);
        AdminTag::deleteRelatedTag($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}