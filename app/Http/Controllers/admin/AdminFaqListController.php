<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminFaqList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PrintHelper;

class AdminFaqListController extends Controller {

    private $title = 'FAQ List';
    private $sort_by = 'sort_order';
    private $sort_order = 'asc';
    private $index_link = 'faq.index';
    // private $list_page = 'admin.faq.list';
    // private $create_form = 'admin.faq.add';
    private $update_form = 'admin.faq.faqlist_edit';
    private $link = 'faq';
    private $linkx = 'faqlist';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $crud = new AdminFaqList;
        $crud->title = $request->title;
        $crud->faq_id = $request->faq_id;
        $crud->status = $request->status;
        $crud->sort_order = PrintHelper::nextSortOrder('tbl_faq_list');
        $crud->save();
        Session::flash('success_message', CREATED);
        return redirect(route($this->link.'.edit',$request->faq_id));
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
        $record = AdminFaqList::findOrFail($id);
        $result = array(
            'page_header'       => 'Edit '.$this->title.' Detail',
            'record'            => $record,
            'link'              => $this->link,
            'linkx'             => $this->linkx,
        );
        echo view($this->update_form, $result);
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
        ]);

        $crud = AdminFaqList::findOrFail($id);
        $crud->title = $request->title;
        $crud->status = $request->status;
        $crud->save();

        Session::flash('success_message', UPDATED);
        return redirect(route($this->link.'.edit',$crud->faq_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crud = AdminFaqList::findOrFail($id);
        $faqid = $crud->faq_id;
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->link.'.edit',$faqid));
    }
}