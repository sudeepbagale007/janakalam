<?php

namespace App\Model\site;

use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    protected $table = 'tbl_post_comments';
    protected $fillable = ['post_id','comment','comment_like','comment_dislike','name','email','comment_report'];
}
