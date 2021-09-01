<?php

namespace App\Model\site;

use Illuminate\Database\Eloquent\Model;

class PostReaction extends Model
{
    protected $table = 'tbl_posts_reaction';
    protected $fillable = ['post_id','laugh','happy','sad','confused','angry'];
}
