<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewPosts extends Model
{
        protected $table = ['new_posts'];
        protected $fillable = ['title','updated_at','description','published_date'];
}
