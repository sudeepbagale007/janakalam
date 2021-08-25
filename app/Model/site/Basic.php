<?php

namespace App\Model\site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Basic extends Model {

	public static function getBrokerList(){
    	$data = DB::table('tbl_brokerlist')
                    ->where('status', '1')
                    ->select('broker_no', 'broker_name', 'address', 'phone_no', 'email')
                    ->orderBy('ordering', 'ASC')
                    ->get();
        return $data;
    }

    public static function getDpMemberList(){
    	$data = DB::table('tbl_dp_memberlist')
                    ->where('status', '1')
                    ->select('dp_id', 'dp_name', 'address', 'phone_no', 'website', 'email')
                    ->orderBy('dp_name', 'ASC')
                    ->get();
        return $data;
    }

    public static function getIpoResultByBoid($boid,$table){
		$data = DB::connection('mysql2')
                    ->table($table)
                    ->where('boid', $boid)
                    ->select('*')
                    ->get();
        return $data;
	}

	public static function getIpoCompanyList(){
		$data = DB::connection('mysql2')
                    ->table('tbl_ipo_list')
                    ->where('status','1')
                    ->select('*')
                    ->orderby('published_date','desc')
                    ->get();
        return $data;
	}

	public static function getIpoTableName($ipo_id){
		$data = DB::connection('mysql2')
                    ->table('tbl_ipo_list')
                    ->where('id',$ipo_id)
                    ->select('ipotable_name')
                    ->first();
        return $data;
	}

	public static function getMutualFundDetail(){
		$data = DB::table('tbl_mutualfund_detail AS MD')
                ->join('tbl_company_list AS C','C.id','=','MD.mutualfund_id')
                ->where('MD.status', '1')
                ->select('C.symbol','C.companyname','MD.fund_size','MD.maturity_date','MD.maturity_period','C.id')
                ->orderBy('C.companyname', 'ASC')
				->get();

		return $data;
	}

	public static function getMutualFundNav($mutualfundid){
		$data = DB::table('tbl_mutualfund_nav')
                ->where('mutualfund_id', $mutualfundid)
                ->where('status', '1')
                ->select('weekly_nav','weekly_nav_date','monthly_nav','monthly_nav_date')
                ->orderBy('weekly_nav_date', 'DESC')
                ->limit(1)
				->first();

		return $data;
	}

	public static function getApiMutualFund($mutualfundid){
		$data = DB::table('tbl_mutualfund_nav')
                ->where('mutualfund_id', $mutualfundid)
                ->where('status', '1')
                ->select('weekly_nav_date','weekly_nav')
                // ->select('weekly_nav_date','weekly_nav','monthly_nav')
                ->orderBy('weekly_nav_date', 'asc')
                // ->limit(16)
                ->get();

		return $data;
	}

	public static function getMutualFundName($comoanyid){
		$data = DB::table('tbl_company_list AS C')
                ->where('C.id', $comoanyid)
                ->select('C.id','C.symbol','C.companyname')
				->first();

		return $data;
	}

	public static function getMutalFundDividend($companyid){
		$data = DB::table('tbl_dividend')
				->join('tbl_fiscalyear','tbl_fiscalyear.id','=','tbl_dividend.yearid')
                ->where('tbl_dividend.companyid', $companyid)
                ->where('tbl_dividend.status', '1')
                ->select('tbl_dividend.cash','tbl_fiscalyear.year')
                ->orderBy('tbl_fiscalyear.ordering', 'desc')
                ->get();

		return $data;
	}

	public static function getNewsSectorList($sectorid){
        $data = DB::table('tbl_posts as P')
                ->join('rel_post_companysector as CS','P.id','=','CS.post_id')
                ->where('CS.sector_id', $sectorid)
                ->where('P.status', '1')
                ->select('P.title', 'P.viewcount', 'P.published_date', 'P.image', 'P.slug', 'P.description')
                ->orderBy('P.published_date', 'DESC')
                ->orderBy('P.ordering', 'DESC')
                ->limit(10)
                ->get();
        return $data;
    }

    public static function getLatestPrice(){
		$data = DB::table('tbl_todayshareprice')
				->orderBy('inserted_date', 'desc')
				->select('inserted_date')
				->take(1)
				->first();
		return $data->inserted_date;
	}

	public static function getTodaySharePrice($date){
		$data = DB::table('tbl_todayshareprice')
				->where('inserted_date', $date)
				->get();
		return $data;
	}

}