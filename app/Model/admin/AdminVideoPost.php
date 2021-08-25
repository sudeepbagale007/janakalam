<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminVideoPost extends Model {

    protected $table = 'tbl_video_post';
    protected $guarded = ['id'];

    public function type(){
    	$data = $this->hasOne(AdminVideoType::Class, 'id', 'video_type_id');
    	return $data;
    }
}
