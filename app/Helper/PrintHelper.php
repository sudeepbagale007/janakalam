<?php

use App\Http\Requests;
use App\Model\site\Home;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class PrintHelper {

    public static function dragDropSorting(){
        $sort_orders = explode(',', Request::get('sort_orders'));
        $ids_order = Request::get('ids_order');

        $ids_order = str_replace('sortable[]=', '', $ids_order);
        $ids_order = substr($ids_order, 1);
        $ids_order = explode('&', $ids_order);

        for ($i = 0; $i < sizeof($ids_order); $i++) {
            DB::table(Request::get('table'))
                    ->where('id', $ids_order[$i])
                    ->update(array('sort_order' => $sort_orders[$i]));
        }
    }

    public static function nextSortOrder($table){
        return DB::table($table)->max('sort_order') + 1;
    }


// upto here 

    public static function updateField(){
        $field_id = strip_tags(trim(Input::get('field_id')));
        $value = strip_tags(trim(Input::get('value')));
        $split_data = explode(':', $field_id);
        $id = $split_data[1];
        $field = $split_data[0];
        if (!empty($id) && !empty($field) && !empty($value)) {
            DB::table(Input::get('table'))
                ->where('id', $id)
                ->update(array($field => $value));
        }
    }

    public static function resetSortOrder($table){
        $models = DB::table($table)->select('id')->orderBy('id', 'asc')->get();
        $i = 1;
        foreach ($models as $m) {
            DB::table($table)->where('id', $m->id)->update(array('sort_order' => $i));
            $i++;
        }
    }

}


function p($data){
    echo "<pre>";
    print_r ($data);
    echo "</pre>";
}

function pe($data){
    echo "<pre>";
    print_r ($data);
    echo "</pre>";
    exit();
}

function str_limit($data,$limit,$end=null){
    $text = Str::limit($data, $limit);
    return trim($text);
}

function str_slug($data,$seperator=null){
    $seperator = ($seperator == null)?'-':$seperator;
    $text = Str::slug($data, $seperator);
    return $text;
}

function postSlug($text){
    $time = time();
    $text = Str::slug($text,'-');
    return $time.'-'.$text;
}


function getStatus($id){
    return ($id == 1)?ACTIVE_STATUS:INACTIVE_STATUS;
}

function getYesNo($id){
    return ($id == 1)?YES_STATUS:NO_STATUS;
}

function chunkfullurl($fullurl){
    if ($fullurl != '') {
        $imagepath = parse_url($fullurl);
        if (!empty($imagepath['path'])) {
            $urls = array_filter(explode('/', $imagepath['path']));
            if (isset($urls[1]) && $urls[1] == 'nepsekhabar') {
                array_shift($urls);
                $chunkurl = implode('/', $urls);
                return $chunkurl;
            }else{
                return $imagepath['path'];
            }
        } else{
            return $fullurl;
        }
    }else{
        return $fullurl;        
    }
}


// fornt end 

function authorName($authorname,$authorid){
    $author = null;
    if (trim($authorname) != '') {
        $author = $authorname;
    }else{
        $author = Home::getAuthorNameById($authorid);
    }
    return $author;
}

function getImage($image=null,$type=null){
    if ($image != '') {
        return asset($image);
    } else{
        return DEFAULT_IMG;
    }
}

function getTodayNepaliDate(){
   // return date('Y F d, l');
    $englishdate = explode('-',date('Y-m-d'));
    $year = $englishdate[0];
    $month = $englishdate[1];
    $day = $englishdate[2];
    $nepalidate = \Bsdate::eng_to_nep($year,$month,$day);
    $formatdate = $nepalidate['year'].' '.$nepalidate['nmonth'].' '.$nepalidate['date'].', '.$nepalidate['day'];
    
    return $formatdate;
}

// 5 mins ago => ५ मिनेट अगाडि
function changeEngHumanDateToNepali($requestdate){
    //return $requestdate;
    if ($requestdate != '') {
        $englishdate = explode(' ',$requestdate);
        $number = $englishdate[0];
        $period = $englishdate[1];
        $ago = $englishdate[2];

        $np_number = changeEngToNepali($number);
        $np_period = changeEngPeriodToNepali($period);
        $np_ago = 'अगाडि';

        $formatdate = $np_number.' '.$np_period.' '.$np_ago;
    } else{
        $formatdate = $requestdate;
    }
    return $formatdate;

}

function changeEngPeriodToNepali($period){
    $np_period = '';
    if ($period == 'second' || $period == 'seconds') {
        $np_period = 'सेकेन्ड';
    }

    if ($period == 'minute' || $period == 'minutes') {
        $np_period = 'मिनेट';
    }

    if ($period == 'hour' || $period == 'hours') {
        $np_period = 'घण्टा';
    }

    if ($period == 'day' || $period == 'days') {
        $np_period = 'दिन';
    }

    if ($period == 'week' ||$period == 'weeks') {
        $np_period = 'हप्ता';
    }

    if ($period == 'month' || $period == 'months') {
        $np_period = 'महिना';
    }

    if ($period == 'year' || $period == 'years') {
        $np_period = 'बर्ष';
    }

    return $np_period;
}

function changeEngToNepali($num){
    $numArray = array(
        '0' => '०',
        '1' => '१',
        '2' => '२',
        '3' => '३',
        '4' => '४',
        '5' => '५',
        '6' => '६',
        '7' => '७',
        '8' => '८',
        '9' => '९',
    );
    $arr = str_split($num);
    $returnValue = '';
    for ($i = 0; $i < count($arr); $i++) {
        $new = $arr[$i];
        $returnValue .= (array_key_exists($new, $numArray)) ? $numArray[$new] : false;
    }
    return $returnValue;
}

// used in detail page
function changeFullDateTimeToNepaliFormat($requestdate){
    if ($requestdate != '') {
        $yeartime = explode(' ',$requestdate);

        $np_date = changeDateToNepaliFormat($yeartime[0]);

        $time = explode(':',$yeartime[1]);
        $hour = changeEngToNepali($time[0]);
        $mins = changeEngToNepali($time[1]);
        $sec = changeEngToNepali($time[2]);

        $np_time = $hour.':'.$mins.':'.$sec;

        $formatdate = $np_date;
    } else{
        $formatdate = $requestdate;
    }
    return $formatdate;
}

function changeDateToNepaliFormat($requestdate){
    //return $requestdate;
    if ($requestdate != '') {
        $englishdate = explode('-',$requestdate);
        $year = $englishdate[0];
        $month = $englishdate[1];
        $day = $englishdate[2];
        $nepalidate = \Bsdate::eng_to_nep($year,$month,$day);
        $formatdate = $nepalidate['year'].' '.$nepalidate['nmonth'].' '.$nepalidate['date'].', '.$nepalidate['day'];
    } else{
        $formatdate = date('Y-m-d');
    }
    return $formatdate;
}

function getHomeAdvertisement($type){
    $adslist = Home::getAdvertisementList($type,$limit=3);
    $result = array(
        'list'  => $adslist,
    );
    return view('site.components.homeads',$result);

}


//  