<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class AdminAdvertisement extends Model {

    protected $table = 'tbl_advertisement';
    protected $guarded = ['id'];

    public function adtype(){
    	$data = $this->hasOne(AdminAdvertisementType::Class, 'id', 'advertisement_id');
    	return $data;
    }
}
