<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminFaqList extends Model {

    protected $table = 'tbl_faq_list';
    protected $guarded = ['id'];
}

