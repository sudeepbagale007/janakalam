<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AdminTag extends Model {
	
    protected $table = 'tbl_tags';
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

    public static function deleteRelatedTag($id){
        $data = DB::table('rel_post_tag')
                ->where('tag_id',$id)
                ->delete();

        return $data;
    }

}
