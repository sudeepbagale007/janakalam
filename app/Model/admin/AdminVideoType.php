<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminVideoType extends Model {

    protected $table = 'tbl_video_type';
    protected $guarded = ['id'];
    public $timestamps = false;
}
