<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminGroupController extends Controller {

    private $title = 'User Group';
    private $sort_by = 'title';
    private $sort_order = 'asc';
    private $index_link = 'usergroup.index';
    private $list_page = 'admin.group.list';
    private $create_form = 'admin.group.add';
    private $update_form = 'admin.group.edit';
    private $link = 'usergroup';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AdminGroup::orderBy($this->sort_by, $this->sort_order)->paginate(PAGES);
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
        $crud = new AdminGroup;
        $crud->title = $request->title;
        $crud->description = $request->description;
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
        $record = AdminGroup::findOrFail($id);
        $list = AdminGroup::orderBy($this->sort_by, $this->sort_order)->paginate(PAGES);
        $result = array(
            'page_header'       => 'Edit '.$this->title.' Detail',
            'record'            => $record,
            'list'              => $list,
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
            'description'        => 'required',
        ]);
        $crud = AdminGroup::findOrFail($id);
        $crud->title = $request->title;
        $crud->description = $request->description;
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
        $crud = AdminGroup::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}