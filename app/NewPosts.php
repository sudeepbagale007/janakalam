<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewPosts extends Model
{
        protected $table = ['new_posts'];
        protected $fillable = ['title','slug','description','description'];
}
