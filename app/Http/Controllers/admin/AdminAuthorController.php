<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuthorController extends Controller {

    private $title = 'Author';
    private $sort_by = 'name';
    private $sort_order = 'asc';
    private $index_link = 'author.index';
    private $list_page = 'admin.author.list';
    private $create_form = 'admin.author.add';
    private $update_form = 'admin.author.edit';
    private $link = 'author';
    private $list;

    public function __construct(){
        $this->list = AdminAuthor::orderBy($this->sort_by, $this->sort_order)->get();
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
            'name'         => 'required',
        ]);
        $crud = new AdminAuthor;
        $crud->name = $request->name;
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
        $record = AdminAuthor::findOrFail($id);
        $result = array(
            'page_header'       => 'Edit '.$this->title.' Detail',
            'record'            => $record,
            'list'              => $this->list,
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
            'name'         => 'required',
            'slug'          => 'required',
        ]);
        $crud = AdminAuthor::findOrFail($id);
        $crud->name = $request->name;
        $crud->description = $request->description;
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
        $crud = AdminAuthor::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}