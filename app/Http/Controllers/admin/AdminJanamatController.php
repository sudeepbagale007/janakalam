<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminJanamatController extends Controller
{
    private $title = 'Janamat';
    private $sort_by = 'title';
    private $sort_order = 'asc';
    private $index_link = 'janamat.index';
    private $list_page = 'admin.janamat.list';
    private $create_form = 'admin.janamat.add';
    private $update_form = 'admin.janamat.edit';
    private $link = 'janamat';
    private $list;
    private $template_list;

    
    public function index(){
        $result = array(
            'page_header'       => 'List of '.$this->title,
        );
        return view($this->list_page, $result);

    }
}

