<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Model\site\Basic;
use App\Model\site\Home;
use Illuminate\Http\Request;
use App\Model\site\PostReaction;

class BasicController extends Controller {

	function shareCalculator(){
		$result = array(
			'page_header'		=> 'Share Calculator',
		);
   		return view('site.tools.sharecalculator', $result);
	}

	function rightShareAdjustmentCalculator(){
		$result = array(
			'page_header'		=> 'Right Share Adjustment Calculator',
		);
   		return view('site.tools.rightsharecalculator', $result);
	}

	function bonusShareAdjustmentCalculator(){
		$result = array(
			'page_header'		=> 'Bonus Share Adjustment Calculator',
		);
   		return view('site.tools.bonussharecalculator', $result);
	}

	public function brokerList(){
		$list = Basic::getBrokerList();
		$result = array(
			'list'				=> $list,
			'page_header'		=> 'Broker List',
		);
   		return view('site.tools.brokerlist', $result);
	}

    public function dpMemberList(){
		$list = Basic::getDpMemberList();
		$result = array(
			'list'				=> $list,
			'page_header'		=> 'DP Member List',
		);
   		return view('site.tools.dpmemberlist', $result);
	}

	public function ipoResult(){
		$ipolist = Basic::getIpoCompanyList();
		$result = array(
			'page_header'		=> 'IPO Result',
			'list'				=> 'all',
			'ipolist'			=> $ipolist,
		);
   		return view('site.iporesult', $result);
	}

	public function ipoResultData(Request $request){
		$this->validate($request, [
                'boid'          => 'required|min:16',
            ]);

		$boid = $request->boid;
		$companyid = $request->companyid;
		$tablename = Basic::getIpoTableName($companyid);
		if (!empty($tablename)) {
			$table = $tablename->ipotable_name;
			$list = Basic::getIpoResultByBoid($boid,$table);
		} else{
			$list = null;
		}
		
		$ipolist = Basic::getIpoCompanyList();
		$result = array(
			'list'				=> $list,
			'ipolist'			=> $ipolist,
			'page_header'		=> 'IPO Result',
			'message_status'	=> 'Congratulation, You have been alloted ..',
		);
   		return view('site.iporesult', $result);
	}

	public function mutualFund(Request $request){
		$mutualfundlist = Basic::getMutualFundDetail();
		foreach ($mutualfundlist as $k => $vl) {
			$mutualfundnav = Basic::getMutualFundNav($vl->id);
			$mutualfundlist[$k]->weekly_nav = !empty($mutualfundnav->weekly_nav)?$mutualfundnav->weekly_nav:'-';
			$mutualfundlist[$k]->weekly_nav_date = !empty($mutualfundnav->weekly_nav_date)?$mutualfundnav->weekly_nav_date:'-';
			$mutualfundlist[$k]->monthly_nav = !empty($mutualfundnav->monthly_nav)?$mutualfundnav->monthly_nav:'-';
			$mutualfundlist[$k]->monthly_nav_date = !empty($mutualfundnav->monthly_nav_date)?$mutualfundnav->monthly_nav_date:'-';
		}
		$newslist = Basic::getNewsSectorList($sector='13');
		$companydetail = Basic::getMutualFundName($companyid='406');
		$mutualfunddividend = Basic::getMutalFundDividend($companyid='406');
		$mutualfundchartdata = Basic::getApiMutualFund($companyid='406');
		$mutualfundchartdata = $mutualfundchartdata->toArray();

		$weekly_nav_date = array_column($mutualfundchartdata, 'weekly_nav_date');
		$weekly_nav_date = json_encode($weekly_nav_date,JSON_NUMERIC_CHECK);

		$weekly_nav = array_column($mutualfundchartdata, 'weekly_nav');
		$weekly_nav = json_encode($weekly_nav,JSON_NUMERIC_CHECK);

		$monthly_nav = array_column($mutualfundchartdata, 'monthly_nav');
		$monthly_nav = json_encode($monthly_nav,JSON_NUMERIC_CHECK);

		$result = array(
			'page_header' 				=> 'Mutual Fund NAV',
			'list' 						=> $mutualfundlist,
			'newslist' 					=> $newslist,
			'weekly_nav_date' 			=> $weekly_nav_date,
			'weekly_nav' 				=> $weekly_nav,
			'monthly_nav' 				=> $monthly_nav,
			'companydetail' 			=> $companydetail,
			'mutualfunddividend' 		=> $mutualfunddividend,
		);
		return view('site.mutualfund', $result);
	}

	public function ajaxMutualFundChart(Request $request){
		if ($request->ajax()) {
			$companyid = $request->company;
			$companydetail = Basic::getMutualFundName($companyid);
			$mutualfunddividend = Basic::getMutalFundDividend($companyid);
			$mutualfundchartdata = Basic::getApiMutualFund($companyid);
			$mutualfundchartdata = $mutualfundchartdata->toArray();

			$weekly_nav_date = array_column($mutualfundchartdata, 'weekly_nav_date');
			$weekly_nav_date = json_encode($weekly_nav_date,JSON_NUMERIC_CHECK);

			$weekly_nav = array_column($mutualfundchartdata, 'weekly_nav');
			$weekly_nav = json_encode($weekly_nav,JSON_NUMERIC_CHECK);

			$monthly_nav = array_column($mutualfundchartdata, 'monthly_nav');
			$monthly_nav = json_encode($monthly_nav,JSON_NUMERIC_CHECK);

			$result = array(
				'page_header' 				=> 'Mutual Fund NAV',
				'weekly_nav_date' 			=> $weekly_nav_date,
				'weekly_nav' 				=> $weekly_nav,
				'monthly_nav' 				=> $monthly_nav,
				'companydetail' 			=> $companydetail,
				'mutualfunddividend' 		=> $mutualfunddividend,
			);
			return view('site.mutualfundchart', $result);
		}else {
			$error = array(
				'error' 		=> 'true' ,
				'message'		=> 'error',
			);
			return response()->json($error);
		}
	}

	public function getapi(){
		$list = Basic::getApiMutualFund('406');
		$apidata=array();
		foreach ($list as $key => $value) {
			$apidata[]=array(strtotime($value->weekly_nav_date),$value->weekly_nav);
		}
		return $apidata;
	}

	public function todaySharePrice(){
		$latestdate = Basic::getLatestPrice();
		$shareprice = Basic::getTodaySharePrice($latestdate);
    	$result = array(
			'page_header'		=> 'Today Share Price',
			'list'				=> $shareprice,
			'latestdate'		=> $latestdate,
		);
   		return view('site.todayshareprice', $result);
	}

	public function updateReaction(Request $request)
	{
		$post_id = $request->post_id;
		$emoji=$request->selected_emoji;
		$reaction_id=$request->reaction_id; 
		$alldata=PostReaction::find($reaction_id);
	

		PostReaction::updateOrCreate(['id'=>$reaction_id?:NULL],
		[
			'post_id'=>$post_id,
			'laugh'=>($emoji=='laugh')?($alldata->laugh+1):$alldata->laugh,
			'sad'=>($emoji=='sad')?($alldata->sad+1):$alldata->sad,
			'happy'=>($emoji=='happy')?($alldata->happy+1):$alldata->happy,
			'angry'=>($emoji=='angry')?($alldata->angry+1):$alldata->angry,
			'confused'=>($emoji=='confused')?($alldata->confused+1):$alldata->confused,
		]);
		dd('done');
		return response()->json(['success'=>'done']);

	}
}
