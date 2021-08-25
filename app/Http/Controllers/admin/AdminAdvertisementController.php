<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminAdvertisement;
use App\Model\admin\AdminAdvertisementType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PrintHelper;

class AdminAdvertisementController extends Controller {

    private $title = 'Advertisement';
    private $sort_by = 'sort_order';
    private $sort_order = 'asc';
    private $index_link = 'advertisement.index';
    private $list_page = 'admin.advertisement.list';
    private $create_form = 'admin.advertisement.add';
    private $update_form = 'admin.advertisement.edit';
    private $link = 'advertisement';
    private $advertisement_list = 'advertisement';


    public function __construct(){
        $this->advertisement_list = AdminAdvertisementType::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($_GET)) {
            $title = $request->input('title');
            $advertisement_id = $request->input('advertisement_id');

            $query = AdminAdvertisement::with('adtype');
            if ($title != '') {
                $query->where('title', 'like', '%' . $title . '%');
            }

            if ($advertisement_id != '') {
                $query->where('advertisement_id', $advertisement_id);
            }

            $list = $query->orderBy($this->sort_by, $this->sort_order)
                    ->paginate(PAGES);
        }else{
            $list = AdminAdvertisement::with('adtype')
                    ->orderBy($this->sort_by, $this->sort_order)
                    ->paginate(PAGES);
        }

        // return $list;
        $result = array(
            'list'                  => $list,
            'page_header'           => 'List of '.$this->title,
            'link'                  => $this->link,
            'advertisement_list'    => $this->advertisement_list,
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
            'page_header'           => 'Add '.$this->title.' Detail',
            'advertisement_list'    => $this->advertisement_list,
            'link'                  => $this->link,
        );
        // return $result;
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
            'title'             => 'required',
            'advertisement_id'  => 'required',
            'image'             => 'required',
        ]);
        $user_id = AdminLoginController::id();
        $crud = new AdminAdvertisement;
        $crud->title = $request->title;
        $crud->advertisement_id = $request->advertisement_id;
        $crud->url = $request->url;
        $crud->image = $request->image;
        $crud->start_time = $request->start_time;
        $crud->end_time = $request->end_time;
        $crud->sort_order = PrintHelper::nextSortOrder('tbl_advertisement');
        $crud->created_by = $user_id;
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
        $record = AdminAdvertisement::findOrFail($id);
        $result = array(
            'page_header'           => 'Edit '.$this->title.' Detail',
            'record'                => $record,
            'link'                  => $this->link,
            'advertisement_list'    => $this->advertisement_list,
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
            'title'     => 'required',
            'image'     => 'required',
        ]);

        $user_id = AdminLoginController::id();
        $crud = AdminAdvertisement::findOrFail($id);
        $crud->title = $request->title;
        $crud->advertisement_id = $request->advertisement_id;
        $crud->url = $request->url;
        $crud->image = $request->image;
        $crud->start_time = $request->start_time;
        $crud->end_time = $request->end_time;
        $crud->updated_by = $user_id;
        $crud->status = $request->status;
        // pe($crud);
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
        $crud = AdminAdvertisement::findOrFail($id);
        $crud->delete();
        Session::flash('success_message', DELETED);
        return redirect(route($this->index_link));
    }
}