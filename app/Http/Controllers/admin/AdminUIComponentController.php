<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminUser;
use Illuminate\Http\Request;

class AdminUIComponentController extends Controller {

    public function uiManagement(){
    	$result = null;
    	return view('admin.ui_skin.index',compact('result'));
    }

    public function uiSkinChange($skin){
    	$userid = AdminLoginController::id();
    	AdminUser::updateUserSkinLayout($skin,$userid);
    	return redirect(route('ui_skin.index'));
    }
}
