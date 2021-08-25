<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminFaq;
use App\Model\admin\AdminFaqList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PrintHelper;

class AdminFaqController extends Controller {

    private $title = 'Frequnently Asked Question';
    private $sort_by = 'sort_order';
    private $sort_order = 'asc';
    private $index_link = 'faq.index';
    private $list_page = 'admin.faq.list';
    private $create_form = 'admin.faq.add';
    private $update_form = 'admin.faq.edit';
    private $link = 'faq';
    private $linkx = 'faqlist';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = AdminFaq::orderBy($this->sort_by, $this->sort_order)->paginate(PAGES);
        if (!empty(($list))) {
            foreach ($list as $k => $val) {
                $totallist = AdminFaqList::where('faq_id',$val->id)->select('title')->get();
                $list[$k]->totallist = $totallist;
            }
        }
        $result = array(
            'list'              => $list,
            'page_header'       => 'List of '.$this->title,
            'link'              => $this->link,
            'linkx'             => $this->linkx,
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
            'linkx'             => $this->linkx,
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
        $crud = new AdminFaq;
        $crud->title = $request->title;
        $crud->description = $request->description;
        $crud->published_date = $request->published_date;
        $crud->status = $request->status;
        $crud->sort_order = PrintHelper::nextSortOrder('tbl_faq');
        $crud->save();
        Session::flash('success_message', CREATED);
        return redirect(route($this->link.'.edit',$crud->id));
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
        $record = AdminFaq::findOrFail($id);
        $faqlist = AdminFaqList::where('faq_id',$record->id)->orderBy('sort_order','asc')->get();
        $result = array(
            'page_header'       => 'Edit '.$this->title.' Detail',
            'faqlist'           => $faqlist,
            'record'            => $record,
            'link'              => $this->link,
            'linkx'             => $this->linkx,
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
        $crud = AdminFaq::findOrFail($id);
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
        $crud = AdminFaq::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}