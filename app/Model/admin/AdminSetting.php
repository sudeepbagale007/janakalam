<?php

namespace App\Model\admin;

use App\Http\Controllers\admin\AdminLoginController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminSetting extends Model {

	protected $table = 'tbl_site_setting';
    protected $guarded = ['id'];

	public static function getUserDesignLayout(){
		$userid = AdminLoginController::id();
		$data = DB::table('tbl_admin_users')
					->where('id',$userid)
					->select('ui_skin')
					->first();

		return $data;
	}

	public static function getMenuName($menuid){
		$data = DB::table('tbl_menus')
					->where('id',$menuid)
					->select('id','name')
					->first();

		return $data;
	}


    public static function nextSortOrder($table,$parameter){    	
        return DB::table($table)->max($parameter) + 1;
    }

	/*public static function getSiteSettingData(){
		$data = DB::table('tbl_site_setting')
					->first();
		return $data;
	}*/
}
