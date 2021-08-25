<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminSector extends Model {

   	protected $table = 'tbl_company_sector';
    protected $guarded = ['id'];

    public function posts(){
    	$data = $this->belongsToMany('App\admin\AdminNews', 'rel_post_companysector');
    	return $data;
    }

    public static function deleteNewsSectorId($id){
        $data =  DB::table('rel_post_companysector')
                ->where('admin_sector_id', $id)
                ->delete();
        return $data;
    }
}
