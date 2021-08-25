<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminFaq extends Model {

    protected $table = 'tbl_faq';
    protected $guarded = ['id'];
}

