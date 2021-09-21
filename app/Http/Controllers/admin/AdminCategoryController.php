<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminCategoryController extends Controller {

    private $title = 'Category';
    private $sort_by = 'title';
    private $sort_order = 'desc';
    private $index_link = 'category.index';
    private $list_page = 'admin.category.list';
    private $create_form = 'admin.category.add';
    private $update_form = 'admin.category.edit';
    private $link = 'category';
    private $list;
    private $template_list;
    // private $slidebar_list;

    public function __construct()
    {
        $this->list = AdminCategory::where('parent_id', '0')->orderBy($this->sort_by, $this->sort_order)->get();
        if(!empty($this->list)){
            foreach ($this->list as $k => $val) {
                $templatename = AdminCategory::getCategoryTemplateName($val->template_id);
                $this->list[$k]->templatename = isset($templatename->title)?$templatename->title:'-';

                // $sidebarname = AdminCategory::getSidebarTemplateName($val->sidebar_id);
                // $this->list[$k]->sidebarname = isset($sidebarname->title)?$sidebarname->title:'-';

                $childlist = AdminCategory::where('parent_id', $val->id)->orderBy($this->sort_by, $this->sort_order)->get();

                if (!empty($childlist)) {
                    foreach ($childlist as $kl => $valx) {
                        $childtemplate = AdminCategory::getCategoryTemplateName($valx->template_id);
                        $childlist[$kl]->templatename = isset($childtemplate->title)?$childtemplate->title:'-';


                        // $childsidebar = AdminCategory::getSidebarTemplateName($valx->sidebar_id);
                        // $childlist[$kl]->sidebarname = isset($childsidebar->title)?$childsidebar->title:'-';
                    }
                }
                $this->list[$k]->childlist = $childlist;
            }
        }

        $this->template_list = AdminCategory::getCategoryTemplateList();
        // $this->slidebar_list = AdminCategory::getSidebarTemplateList();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $this->list;
        $result = array(
            'list'              => $this->list,
            'page_header'       => 'List of '.$this->title,
            'link'              => $this->link,
            'template_list'     => $this->template_list,
            // 'slidebar_list'     => $this->slidebar_list,
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
            'template_list'     => $this->template_list,
            // 'slidebar_list'     => $this->slidebar_list,
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
            'title'         => 'required',
            'template_id'   => 'required',
        ]);
        $crud = new AdminCategory;
        $crud->title = $request->title;
        $crud->parent_id = $request->parent_id;
        $crud->template_id = $request->template_id;
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
        $record = AdminCategory::findOrFail($id);
        $result = array(
            'page_header'       => 'Edit '.$this->title.' Detail',
            'record'            => $record,
            'list'              => $this->list,
            'link'              => $this->link,
            'template_list'     => $this->template_list,
            // 'slidebar_list'     => $this->slidebar_list,
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
            'title'         => 'required',
            'slug'          => 'required',
            'template_id'   => 'required',
        ]);
        $crud = AdminCategory::findOrFail($id);
        $crud->title = $request->title;
        $crud->parent_id = $request->parent_id;
        $crud->slug = str_slug($request->slug,'-');
        $crud->template_id = $request->template_id;
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
        $crud = AdminCategory::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}