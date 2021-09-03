<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class PublicOpinion extends Model
{
    protected $table = 'tbl_public_opinions';
    protected $fillable = ['answers','question'];
}
