<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Model {


	public static function getTopPostViews($startdate,$enddate){
		$startdate = $startdate.' 00:00:00';
        $enddate = $enddate.' 23:00:00';

		$data = DB::table('tbl_posts')
				->where('status',1)
				->whereBetween('published_date', array($startdate, $enddate))
				->select('id','title','published_date','slug','viewcount')
				->orderby('published_date','asc')
				// ->limit(100)
				->get();
		return $data;
	}

	public static function getTopPostViewsByAuthorId($authorid,$startdate,$enddate){
		$startdate = $startdate.' 00:00:00';
        $enddate = $enddate.' 23:00:00';

		$data = DB::table('tbl_posts')
				->where('status',1)
				->where('author_id',$authorid)
				->whereBetween('published_date', array($startdate, $enddate))
				->select('id','title','published_date','slug','viewcount')
				->orderby('published_date','asc')
				->get();
		return $data;
	}

	public static function getTopPostViewsByCategoryId($categoryid,$startdate,$enddate){
		$startdate = $startdate.' 00:00:00';
        $enddate = $enddate.' 23:00:00';

		$data = DB::table('tbl_posts as P')
				->join('rel_post_category as PC','PC.post_id','=','P.id')
				->where('P.status',1)
				->where('PC.category_id',$categoryid)
				->whereBetween('published_date', array($startdate, $enddate))
				->select('P.id','P.title','P.published_date','P.slug','P.viewcount')
				->orderby('P.published_date','asc')
				->get();
		return $data;
	}

}