<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AdminCategory extends Model {
	
    protected $table = 'tbl_category';
    protected $guarded = ['id'];
    public $timestamps = false;

    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }


   	public function posts(){
   		return $this->belongsToMany(AdminPosts::Class, 'tbl_post_category', 'category_id', 'post_id');
    }

    // tempate
    public static function getCategoryTemplateList(){
        $data = DB::table('tbl_category_template')
                ->where('status',1)
                ->orderBy('id','asc')
                ->get();

        return $data;
    }

    public static function getCategoryTemplateName($templateid){
        $data = DB::table('tbl_category_template')
                ->where('id',$templateid)
                ->select('id','title')
                ->first();

        return $data;
    }

    // sidebar
    public static function getSidebarTemplateList(){
        $data = DB::table('tbl_sidebar_template')
                ->where('status',1)
                ->orderBy('id','asc')
                ->get();

        return $data;
    }

    public static function getSidebarTemplateName($sidebarid){
        $data = DB::table('tbl_sidebar_template')
                ->where('id',$sidebarid)
                ->select('id','title')
                ->first();

        return $data;
    }
}
