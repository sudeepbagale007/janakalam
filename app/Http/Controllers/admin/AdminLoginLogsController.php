<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\admin\AdminFailLoginLogs;
use App\Model\admin\AdminSuccessLoginLogs;
use Illuminate\Http\Request;

class AdminLoginLogsController extends Controller {
    
    public function successLogin(){
    	$loginlist = AdminSuccessLoginLogs::getSuccessLoginList();
    	$result = array(
    		'page_header' 		=> 'Login Logs', 
    		'list' 				=> $loginlist, 
    	);
        return view('admin.logs.successlogin', $result);
    }

    public function failLogin(){
    	$failLogins = AdminFailLoginLogs::orderBy('created_at','desc')->paginate(20);
    	$result = array(
    		'page_header' 		=> 'Login Logs', 
    		'list' 				=> $failLogins, 
    	);
        return view('admin.logs.faillogin', $result);
    }
}
