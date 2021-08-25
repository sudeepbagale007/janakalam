<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Model\admin\AdminAuthor;
use App\Model\admin\AdminCategory;
use App\Model\admin\AdminDashboard;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller{

    public function mediaLibrary(){
    	$result = array(
    		'page_header' => 'Media Library',
    	);
    	return view('admin.medialibrary',$result);
    }


    public function topViewsData(Request $request){
        $startdate = date("Y-m-d");
        // $startdate = date("Y-m-d", strtotime("-1 weeks"));
        $enddate = date('Y-m-d');

        if ($request->startdate != '') {
            $startdate = $request->startdate;
        }

        if ($request->enddate != '') {
            $enddate = $request->enddate;
        }

        $list = AdminDashboard::getTopPostViews($startdate,$enddate);
    	$result = array(
    		'page_header'     => 'All Views',
            'startdate'       => $startdate,
            'enddate'         => $enddate,
            'list'            => $list,
    	);
    	return view('admin.dashboard.topviewsdata',$result);
    }

    public function topViewsJson(Request $request){
    	$startdate = date("Y-m-d", strtotime("-1 weeks"));
    	$enddate = date('Y-m-d');

    	if ($request->startdate != '') {
    		$startdate = $request->startdate;
    	}

    	if ($request->enddate != '') {
    		$enddate = $request->enddate;
    	}

    	$data = AdminDashboard::getTopPostViews($startdate,$enddate);
    	return response()->json($data,200);
    }

    public function authorData(Request $request){
        $startdate = date("Y-m-d", strtotime("-1 weeks"));
        $enddate = date('Y-m-d');

        if ($request->startdate != '') {
            $startdate = $request->startdate;
        }

        if ($request->enddate != '') {
            $enddate = $request->enddate;
        }

        $data = AdminAuthor::where('status',1)->select('id','name')->get();
        if (!empty($data)) {
            foreach ($data as $k => $val) {
                $totalpost = AdminDashboard::getTopPostViewsByAuthorId($val->id,$startdate,$enddate);
                $data[$k]->totalpost = $totalpost;
            }
        }

        $finaldata = array();
        if (!empty($data)) {
            foreach ($data as $k => $valx) {
                if (count($valx->totalpost) > 0) {
                    $finaldata[] = $valx;
                }
            }
        }

        $result = array(
            'page_header'     => 'Author wise Posts',
            'startdate'       => $startdate,
            'enddate'         => $enddate,
            'list'            => $finaldata,
        );

        // return $data;
        return view('admin.dashboard.authordata',$result);
    }

    public function authorJson(Request $request){
        $startdate = date("Y-m-d", strtotime("-1 weeks"));
        $enddate = date('Y-m-d');

        if ($request->startdate != '') {
            $startdate = $request->startdate;
        }

        if ($request->enddate != '') {
            $enddate = $request->enddate;
        }

        $data = AdminAuthor::where('status',1)->select('id','name')->get();
        if (!empty($data)) {
            foreach ($data as $k => $val) {
                $totalpost = AdminDashboard::getTopPostViewsByAuthorId($val->id,$startdate,$enddate);
                $data[$k]->totalpost = count($totalpost);
            }
        }

        $finaldata = array();
        if (!empty($data)) {
            foreach ($data as $k => $valx) {
                if ($valx->totalpost > 0) {
                    $finaldata[] = $valx;
                }
            }
        }
        return response()->json($finaldata,200);
    }


    public function categoryData(Request $request){
        $startdate = date("Y-m-d", strtotime("-1 weeks"));
        $enddate = date('Y-m-d');

        if ($request->startdate != '') {
            $startdate = $request->startdate;
        }

        if ($request->enddate != '') {
            $enddate = $request->enddate;
        }

        $data = AdminCategory::where('parent_id',0)->where('status',1)->select('id','title','slug')->get();
        if (!empty($data)) {
            foreach ($data as $k => $val) {
                $totalpost = AdminDashboard::getTopPostViewsByCategoryId($val->id,$startdate,$enddate);
                $data[$k]->totalpost = $totalpost;
            }
        }

        $finaldata = array();
        if (!empty($data)) {
            foreach ($data as $k => $valx) {
                if (count($valx->totalpost) > 0) {
                    $finaldata[] = $valx;
                }
            }
        }

        $result = array(
            'page_header'     => 'Category wise Posts',
            'startdate'       => $startdate,
            'enddate'         => $enddate,
            'list'            => $finaldata,
        );

        // return $data;
        return view('admin.dashboard.categorydata',$result);
    }

    public function categoryJson(Request $request){
        $startdate = date("Y-m-d", strtotime("-1 weeks"));
        $enddate = date('Y-m-d');

        if ($request->startdate != '') {
            $startdate = $request->startdate;
        }

        if ($request->enddate != '') {
            $enddate = $request->enddate;
        }

        $data = AdminCategory::where('parent_id',0)->where('status',1)->select('id','title','slug')->get();
        if (!empty($data)) {
            foreach ($data as $k => $val) {
                $totalpost = AdminDashboard::getTopPostViewsByCategoryId($val->id,$startdate,$enddate);
                $data[$k]->totalpost = count($totalpost);
            }
        }

        $finaldata = array();
        if (!empty($data)) {
            foreach ($data as $k => $valx) {
                if ($valx->totalpost > 0) {
                    $finaldata[] = $valx;
                }
            }
        }
        return response()->json($finaldata,200);
    }

}

