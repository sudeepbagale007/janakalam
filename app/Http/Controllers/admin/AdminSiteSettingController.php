<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminFailLoginLogs;
use App\Model\admin\AdminSetting;
use App\Model\admin\AdminSuccessLoginLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminSiteSettingController extends Controller {
    
    public function successLogin(){
    	$loginlist = AdminSuccessLoginLogs::getSuccessLoginList();
    	$result = array(
    		'page_header' 		=> 'Login Logs', 
    		'list' 				=> $loginlist, 
    	);
        return view('admin.logs.successlogin', compact('result'));
    }

    public function failLogin(){
    	$failLogins = AdminFailLoginLogs::orderBy('created_at','desc')->paginate(20);
    	$result = array(
    		'page_header' 		=> 'Login Logs', 
    		'list' 				=> $failLogins, 
    	);
        return view('admin.logs.faillogin', compact('result'));
    }

    function setting(){
        $settingdata = AdminSetting::find(1);
        $result = array(
            'page_header'       => 'Site Setting Management',
            'settingdata'       => $settingdata,
        );
        return view('admin.setting', $result);
    }

    function updateSetting(Request $request){
        $inputs = $request->all();
        $user_id = AdminLoginController::id();
        $data = AdminSetting::findOrFail(1);
        $inputs['updated_by'] = $user_id;
        $data->fill($inputs);
        $data->save();
        Session::flash('success_message', "Successfully Updated !!!");
        return redirect(route('setting'));
    }
}
