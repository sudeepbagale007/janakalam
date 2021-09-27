<?php

namespace App\Model\site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model {

    public static function getBreakingNewsList(){
        $limit = DB::table('tbl_site_setting')->select('breaking_news_count')->first()->breaking_news_count;
        $data = DB::table('tbl_posts')
                ->where('breaking_news',1)
                ->where('status', 1)
                ->select('title', 'image', 'published_date', 'description','slug','sub_heading','author_name','author_id','show_image','short_text','news_bereaking_category')
                ->orderBy('published_date', 'DESC')
                ->limit($limit)
                ->get();
        return $data;
    }

    public static function getAuthorNameById($id){
        $data = DB::table('tbl_author')
                ->where('id',$id)
                ->first();
        $data = isset($data->name)?$data->name:'';
        return $data;
    }

    public static function getAllLatestPostList($limit=6){
        $data = DB::table('tbl_posts AS P')
                ->where('P.status', '1')
                ->select('P.id','P.title', 'P.image', 'P.published_date', 'P.slug', 'P.description')
                ->orderBy('P.published_date', 'DESC')
                ->limit($limit)
                ->get();

        return $data;
    }

     public static function getAllLatestPostListHome($limit=9){
        $data = DB::table('tbl_posts AS P')
                ->where('P.status', '1')
                ->select('P.id','P.title', 'P.image', 'P.published_date', 'P.slug', 'P.description')
                ->orderBy('P.published_date', 'DESC')
                ->limit($limit)
                ->get();

        return $data;
    }

    public static function getHomePostListDescription($category,$limit =5){
        $data = Self::getCategoryNameBySlug($category);
        if (!empty($data)) {
            $list = DB::table('tbl_posts AS P')
                ->join('rel_post_category AS PC','PC.post_id','=','P.id')
                ->where('PC.category_id', $data->id)
                ->where('P.status', 1)
                ->select('P.title', 'P.image', 'P.published_date', 'P.description','P.slug','P.author_name','P.author_id','P.show_image','P.short_text','P.interviewer_name')
                ->orderBy('P.published_date', 'DESC')
                ->limit($limit)
                ->get();
            
            $data->list = $list;
        }

        return $data;
    }
    
    public static function getHomePostList($category,$limit =5){
        $data = Self::getCategoryNameBySlug($category);
        if (!empty($data)) {
            $list = DB::table('tbl_posts AS P')
                    ->join('rel_post_category AS PC','PC.post_id','=','P.id')
                    ->where('PC.category_id', $data->id)
                    ->where('P.status', 1)
                    ->select('P.title', 'P.image', 'P.published_date','P.slug')
                    ->orderBy('P.published_date', 'DESC')
                    ->limit($limit)
                    ->get();
            $data->list = $list;
        }

        return $data;
    }

    public static function getHomePostListParentChild($category,$limit =5){
        $data = Self::getCategoryNameBySlug($category);
        if (!empty($data)) {
            $childdata = DB::table('tbl_category')
                            ->where('parent_id', $data->id)
                            ->where('status', 1)
                            ->select('id','title','slug')
                            ->get();
            if (!empty($childdata)) {
                foreach ($childdata as $k => $val) {
                    $list = DB::table('tbl_posts AS P')
                            ->join('rel_post_category AS PC','PC.post_id','=','P.id')
                            ->where('PC.category_id', $val->id)
                            ->where('P.status', 1)
                            ->select('P.title', 'P.image', 'P.published_date','P.slug')
                            ->orderBy('P.published_date', 'DESC')
                            ->limit($limit)
                            ->get();
                    $childdata[$k]->list = $list;
                }
                $data->childdata = $childdata;
            }
        }
        return $data;
    }

    public static function getCategoryNameBySlug($slug){
        $data = DB::table('tbl_category')
            ->where('slug', $slug)
            ->where('status', '1')
            ->select('id','title','parent_id','slug')
            ->first();
        return $data;
    }

    public static function getVideoList($limit=10){
        $data = DB::table('tbl_videos')
            ->where('status',1)
            ->select('id','title','image','published_date','youtube_url')
            ->orderBy('published_date','desc')
            ->limit($limit)
            ->get();
        return $data;
    }

    public static function getPagesDetail($slug){
         $data = DB::table('tbl_pages')
                ->where('slug', $slug)
                ->where('status', '1')
                ->select('id','title','description','image','fb_image','published_date')
                ->first();
        return $data;
    }

    public static function updatePostsViewCount($id){
        $data = DB::table('tbl_posts')
                ->where('id', $id)
                ->increment('viewcount', 1);
        return $data;
    }

    public static function updatePagesViewCount($id){
        $data = DB::table('tbl_pages')
                ->where('id', $id)
                ->increment('viewcount', 1);
        return $data;
    }

    public static function getPostDetail($slug){
        // dd($slug);
         $data = DB::table('tbl_posts')
                ->select('id','title','description','image','short_text','sub_heading','show_image', 'fb_image','published_date','video_url','author_name', 'author_id')
                ->where('slug', $slug)
                ->first();
        return $data;
    }

    public static function getPostCategoryList($postid){
        $data = DB::table('rel_post_category AS PC')
            ->join('tbl_category AS C', 'C.id', '=', 'PC.category_id')
            ->where('PC.post_id', $postid)
            ->where('C.status', '1')
            ->select('C.id','C.title', 'C.slug')
            ->orderBy('C.title','asc')
            ->limit(1)
            ->first();
        return $data;
    }

    public static function getRelatedCategoryList($categoryid,$postid){
        $data = DB::table('rel_post_category AS PC')
            ->join('tbl_posts AS P', 'P.id', '=', 'PC.post_id')
            ->where('PC.category_id', $categoryid)
            ->where('P.id', '!=', $postid)
            ->where('P.status', '1')
            ->select('P.title','P.slug', 'P.image','P.published_date','P.description')
            ->orderBy('P.published_date','desc')
            ->limit(6)
            ->get();
        return $data;
    }

    public static function getFaqData(){
        $data = DB::table('tbl_faq')
                ->where('status',1)
                ->select('id','title','description')
                ->orderBy('sort_order','asc')
                ->get();
        return $data;
    }

    public static function getFaqDataChildList($faqid){
        $data = DB::table('tbl_faq_list')
                ->where('status',1)
                ->where('faq_id',$faqid)
                ->select('title')
                ->orderBy('sort_order','asc')
                ->get();
        return $data;
    }

    public static function getCategoryName($slug){
        $data = DB::table('tbl_category as C')
                ->join('tbl_category_template as CT','C.template_id','=','CT.id')
                ->where('C.slug', $slug)
                ->where('C.status', 1)
                ->select('C.id','C.title','C.slug','C.parent_id','C.template_id','CT.template_file')
                ->first();
        return $data;
    }

    

    public static function getPostListByCategoryId($categoryid,$limit){
        $data = DB::table('tbl_posts AS P')
            ->join('rel_post_category AS PC', 'PC.post_id', '=', 'P.id')
            ->where('PC.category_id', $categoryid)
            ->where('P.status', 1)
            ->select('P.title', 'P.published_date', 'P.image', 'P.description', 'P.slug','P.interviewer_name')
            ->orderBy('P.published_date', 'DESC')
            ->paginate($limit);
        return $data;
    }

    public static function getSearch($tablename,$title){
         $data = DB::table($tablename)
                ->where('title', 'like', '%'.$title.'%')
                ->where('status', '1')
                ->select('title','slug','published_date','image','description')
                ->orderBy('published_date','desc')
                // ->limit(15)
                ->paginate(12);
        return $data;
    }

    public static function getPopularNewsList($limit){
        $todaydate = date('Y-m-d H:i:s');
        $previousdate = date("Y-m-d H:i:s", strtotime("-4 weeks"));
        $data = DB::table('tbl_posts')
                ->whereBetween('published_date', array($previousdate, $todaydate))
                ->where('status', '1')
                ->select('title','published_date','slug')
                ->orderBy('viewcount', 'desc')
                ->limit($limit)
                ->get();

        return $data;
    }

    public static function getAdvertisement($type){
        $nowtime = date('Y-m-d H:i:s');
        $data = DB::table('tbl_advertisement as A')
            ->join('tbl_advertisement_type as AT', 'AT.id', '=', 'A.advertisement_id')
            ->where('AT.ads_code', $type)
            ->where('A.start_time', '<', $nowtime)
            ->where('A.end_time', '>', $nowtime)
            ->where('A.status', '1')
            ->select('A.title','A.url','A.image','A.url')
            ->first();
        return $data;
    }

    public static function getAdvertisementList($type,$limit=null){
        $query = DB::table('tbl_advertisement as A')
            ->join('tbl_advertisement_type as AT', 'AT.id', '=', 'A.advertisement_id')
            ->where('AT.ads_code', $type)
            ->where('A.status', 1)
            ->select('A.title','A.url','A.image','A.url')
            ->orderBy('A.sort_order','asc');
            if($limit != ''){
                $query->limit($limit);
            }
        $data = $query->get();

        return $data;
    }

    public static function getTrendingDataById($id){
        $data = DB::table('tbl_tags')
                ->where('id',$id)
                ->first();
        return $data;
    }

    public static function getPostListByTrendId($id){
        $data = DB::table('tbl_posts AS P')
                ->join('rel_post_tag AS PT', 'PT.post_id', '=', 'P.id')
                ->where('PT.tag_id', $id)
                ->where('P.status', 1)
                ->select('P.title', 'P.published_date', 'P.image', 'P.description', 'P.slug')
                ->orderBy('P.published_date', 'DESC')
                ->paginate(6);
        return $data;
    }



    // up to here



    public static function getCategoryList(){
        $data = DB::table('tbl_category')
            ->where('status', 1)
            ->select('id', 'title', 'slug')
            ->orderBy('title', 'asc')
            ->get();
        return $data;
    }

    // public static function getAllPopularStoriesList($limit =5){
    //     $data = DB::table('tbl_posts AS P')
    //             // ->join('rel_post_category AS PC','PC.post_id','=','P.id')
    //             // ->join('tbl_category AS C','C.id','=','PC.category_id')
    //             ->where('P.status', '1')
    //             ->select('P.id','P.title', 'P.image', 'P.published_date', 'P.slug')
    //             ->orderBy('P.published_date', 'DESC')
    //             ->limit($limit)
    //             ->get();

    //     return $data;
    // }
    
    // public static function getCategorySingleId($postid){
    //     $data = DB::table('rel_post_category')
    //         ->where('post_id', $postid)
    //         ->select('category_id')
    //         ->first();
    //     return isset($data->category_id)?$data->category_id:null;
    // }
    
    // public static function getCategoryNameById($id){
    //     $data = DB::table('tbl_category')
    //         ->where('id', $id)
    //         ->where('status', '1')
    //         ->select('title as category_title','slug as category_slug')
    //         ->first();
    //     return $data;
    // }

    // public static function getCategoryList($slug)
    // {
    //     $data = DB::table('tbl_posts AS P')
    //         ->join('rel_post_category AS PC', 'PC.post_id', '=', 'P.id')
    //         ->join('tbl_category AS C', 'C.id', '=', 'PC.category_id')
    //         ->where('C.slug', $slug)
    //         ->where('P.status', '1')
    //         ->select('P.title', 'P.published_date', 'P.image', 'P.description', 'P.slug', 'C.title as category_title')
    //         ->orderBy('P.published_date', 'DESC')
    //         ->paginate(10);
    //     return $data;
    // }

    // public static function getCategoryLimitData($slug)
    // {
    //     $data = DB::table('tbl_posts AS P')
    //         ->join('rel_post_category AS PC', 'PC.post_id', '=', 'P.id')
    //         ->join('tbl_category AS C', 'C.id', '=', 'PC.category_id')
    //         ->where('C.slug', $slug)
    //         ->where('P.status', '1')
    //         ->select('P.title', 'P.published_date', 'P.image', 'P.description', 'P.slug', 'C.title as category_title')
    //         ->orderBy('P.published_date', 'DESC')
    //         ->limit(3)
    //         ->get();
    //     return $data;
    // }

    // public static function getChildCategory($parentid){
    //     $data = DB::table('tbl_category')
    //         ->where('status', '1')
    //         ->where('parent_id', $parentid)
    //         ->select('id','title', 'slug')
    //         ->get();
    //     return $data;
    // }

    // public static function getChildCategoryList($slug){
    //     $data = DB::table('tbl_posts AS P')
    //         ->join('rel_post_category AS PC', 'PC.post_id', '=', 'P.id')
    //         ->join('tbl_category AS C', 'C.id', '=', 'PC.category_id')
    //         ->where('C.slug', $slug)
    //         ->where('P.status', '1')
    //         ->select('P.title', 'P.published_date', 'P.image', 'P.slug')
    //         ->orderBy('P.published_date', 'DESC')
    //         ->limit(4)
    //         ->get();
    //     return $data;
    // }

    /* upto here*/
}