<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMenuController extends Controller {
    
    public function index(){
    	return view('admin.menu.index');
    }

    public function getAdminMenuList(){
    	
    } 
}
