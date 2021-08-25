<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class AdminAdvertisementType extends Model {

    protected $table = 'tbl_advertisement_type';
    protected $guarded = ['id'];
    public $timestamps = false;
}
