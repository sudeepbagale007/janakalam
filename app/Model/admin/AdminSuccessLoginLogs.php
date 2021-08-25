<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminSuccessLoginLogs extends Model {

    protected $table = 'tbl_user_login_logs';
    protected $guarded = ['id'];
    public $timestamps = false;

    public static function getSuccessLoginList(){
    	$data = DB::table('tbl_user_login_logs AS L')
    				->leftjoin('tbl_admin_users AS A','L.user_id','A.id')
					->select('L.*','A.username')
                    ->orderBy('L.login_date','desc')
					->paginate(20);

		return $data;
    }

}

