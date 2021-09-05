<?php

namespace App\Model\site;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'tbl_users_opinions';
    protected $fillable = ['janamat_id','answer','user_email'];
}
