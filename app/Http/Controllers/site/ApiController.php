<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Model\site\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller {

    public function categoryApiList(){
        $list = Home::getCategoryList();
        $result = array(
            'status_code'   => 200,
            'message'       => 'Data Fetch',
            'list'          => $list,
        );
        return response()->json($result,200);
    }

    public function newsApiList($slug){
        $datalist = Home::getHomePostListDescription($slug);
        if (!empty($datalist)) {
        	foreach ($datalist->list as $k => $val) {
        		if($val->author_id != ''){
        			$author = Home::getAuthorNameById($val->author_id);
        		}else{
        			$author = array();
        		}
        		$datalist->list[$k]->author = $author;
        	}
        }
        $result = array(
            'status_code'   => 200,
            'message'       => 'Data Fetch',
            'list'          => $datalist,
        );
        return response()->json($result,200);
    }

}