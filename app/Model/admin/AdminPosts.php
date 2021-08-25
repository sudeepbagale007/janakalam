<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AdminPosts extends Model {

    protected $table = 'tbl_posts';
    protected $guarded = ['id'];

    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function category(){
    	$data = $this->belongsToMany(AdminCategory::Class, 'rel_post_category', 'post_id', 'category_id');
    	return $data;
    }

    public function tags(){
        $data = $this->belongsToMany(AdminTag::Class, 'rel_post_tag', 'post_id', 'tag_id');
        return $data;
    }

    public function sector(){
        $data = $this->belongsToMany(AdminSector::Class, 'rel_post_companysector', 'post_id', 'sector_id');
        return $data;
    }

    public function company(){
        $data = $this->belongsToMany(AdminCompanyList::Class, 'rel_post_companyname', 'post_id', 'company_id');
        return $data;
    }

    public static function deletePostsCategoryList($id){
        $data = DB::table('rel_post_category')
                ->where('post_id', $id)
                ->delete();
        return $data;
    }

    public static function deletePostsCompanyList($id){
        $data = DB::table('rel_post_companyname')
                ->where('post_id', $id)
                ->delete();
        return $data;
    }

    public static function deletePostsSectorList($id){
        $data = DB::table('rel_post_companysector')
                ->where('post_id', $id)
                ->delete();
        return $data;
    }

    public static function deletePostsTagsList($id){
        $data = DB::table('rel_post_tag')
                ->where('post_id', $id)
                ->delete();
        return $data;
    }
}
