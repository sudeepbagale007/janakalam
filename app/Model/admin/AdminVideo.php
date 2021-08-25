<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminVideo extends Model {

    protected $table = 'tbl_videos';
    protected $guarded = ['id'];
}

