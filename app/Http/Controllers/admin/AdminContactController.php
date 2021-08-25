<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\AdminContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminContactController extends Controller {

    private $title = 'Contact Us';
    private $sort_by = 'inserted_date';
    private $sort_order = 'desc';
    private $index_link = 'contact.index';
    private $list_page = 'admin.contact.list';
    private $create_form = 'admin.contact.add';
    private $update_form = 'admin.contact.edit';
    private $link = 'contact';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AdminContact::getContactList();
        $result = array(
            'list'              => $list,
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
        $record = AdminContact::findOrFail($id);
        $record->viewed = 1;
        $record->save();
        $result = array(
            'page_header'       => 'View '.$this->title.' Detail',
            'record'            => $record,
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
            'viewed'              => 'required',
        ]);

        $crud = AdminContact::findOrFail($id);
        $crud->viewed = $request->viewed;
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
        $crud = AdminContact::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}