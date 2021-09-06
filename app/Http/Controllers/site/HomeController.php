<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Model\admin\AdminContact;
use App\Model\admin\AdminVideo;
use App\Model\admin\AdminVideoPost;
use App\Model\admin\Album;
use App\Model\admin\Gallery;
use App\Model\site\Home;
use App\Model\site\PostComments;
use App\Model\site\PostReaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller {

	public function index(){
        $breakingnews = Home::getBreakingNewsList();
        $latestHome = Home::getAllLatestPostListHome($limit=9);
        $news = Home::getHomePostListDescription($type='news',$limit=7);
        $opinion = Home::getHomePostListDescription($type='opinion',$limit=7);
        $international = Home::getHomePostListDescription($type='international',$limit=11);
        $finance = Home::getHomePostListDescription($type='finance',$limit=11);
        $technology = Home::getHomePostListDescription($type='information-technology',$limit=6);
        $sports = Home::getHomePostListDescription($type='sports',$limit=5);
        $lifestyle = Home::getHomePostListDescription($type='lifestyle',$limit=4);
        $interview = Home::getHomePostListDescription($type='interview',$limit=5);
        $literature = Home::getHomePostListDescription($type='literature',$limit=6);
        $article = Home::getHomePostList($type='article',$limit=5);
        $video = Home::getVideoList($limt=10);
        $entertainment = Home::getHomePostListDescription($type='entertainment',$limit=4);
        $videoPosts = AdminVideoPost::where('status','1')->where('show_on_homepage','1')->get();
        $albums = Album::where('status','1')->limit(8)->get();

        $janamat=DB::table('tbl_public_opinions')
                    ->get();

        $result = array(
            'page_header'       => 'Home',
            'breakingnews'      => $breakingnews,
            'albums'            => $albums,
            'latestHome'        => $latestHome,
            'news'              => $news,
            'finance'           => $finance,
            'international'     => $international,
            'technology'        => $technology,
            'sports'            => $sports,
            'article'           => $article,
            'lifestyle'         => $lifestyle,
            'interview'         => $interview,
            'literature'        => $literature,
            'video'             => $video,
            'entertainment'     => $entertainment,
            'videoPosts'        => $videoPosts,
            'opinion'           =>$opinion,
            'janamat'           =>$janamat
        );

        return view('site.home', $result);
    }

    public function pagesDetail($slug){
        $detail = Home::getPagesDetail($slug);
        if (!empty($detail)) {
            Home::updatePagesViewCount($detail->id);
            // $topads = Home::getAdvertisement('dp-h2');
            
            $result = array(
                'detail'        => $detail,
                // 'topads'        => $topads,
            );
            return view('site.pagedetail', $result);
        } else {
            return view('errors.404');
        }
    }

    public function postDetail($slug){
        $detail = Home::getPostDetail($slug);
        $post_reaction = PostReaction::where('post_id',$detail->id)->first();
        $post_comments = PostComments::where('post_id',$detail->id)->get();
        $previous = DB::table('tbl_posts')->where('id', '<', $detail->id)->orderBy('id','desc')->first();
        $next = DB::table('tbl_posts')->where('id', '>', $detail->id)->orderBy('id')->first();

        if (!empty($detail)) {
            Home::updatePostsViewCount($detail->id);
            $category = Home::getPostCategoryList($detail->id);
            if(!empty($category)){
                $categorypostlist = Home::getRelatedCategoryList($category->id,$detail->id);
            }

            // $topads = Home::getAdvertisement('dp-h1');
            $bottomads = Home::getAdvertisementList('dp-f1');
            $result = array(
                'detail'                => $detail,
                'category'              => $category,
                'categorypostlist'      => $categorypostlist,
                // 'topads'                => $topads,
                'bottomads'             => $bottomads,
                'post_reaction'         => $post_reaction,
                'post_comments'          =>  $post_comments,
                'previous'              =>$previous,
                'next'                  =>$next
            );
            // return $result;
            return view('site.postdetail', $result);
        } else{
            return view('errors.404');
        }

    }

    public function videoData(){
        $list=AdminVideo::where('status','1')->orderBy('created_at','DESC')->get();
        $result = array(
            'page_header'           => 'भिडियो',
            'list'                  => $list,
        );
        return view('site.video', $result);
    }

    public function albumData(){
        $albums = Album::where('status','1')->limit(8)->get();
        $result = array(
            'page_header'           => 'फोटो ग्यालेरी',
            'albums'                => $albums,
        );
        return view('site.album', $result);
    }

        public function albumSingle($slug){
        $album=Album::where('slug',$slug)->first();
        if (!empty($album)) {
        $photos=Gallery::where('album_id',$album->id)->where('status','1')->get();
        $result = array(
            'page_header'           => 'फोटो ग्यालेरी',
            'album'                 => $album,
            'photos'                => $photos,
        );
        return view('site.gallery',$result);
        }else{
            return view('errors.404');
        }
    }
    
    


    public function faqData(){
        $list = Home::getFaqData();
        if (!empty($list)) {
            foreach ($list as $k => $val) {
                $childlist = Home::getFaqDataChildList($val->id);
                $list[$k]->chlidlist = $childlist;
            }
        }
        $result = array(
            'page_header'           => 'Frequently Asked Question [FAQ]',
            'list'                  => $list,
        );
        // return $list;
        return view('site.faq', $result);
    }

    public function contactUs(){
        $result = array(
            'page_header' => 'सम्पर्क',
        );
        return view('site.contact', $result);
    }

    public function unicode(){
        $result = array(
            'page_header' => 'सम्पर्क',
        );
        return view('site.unicode', $result);
    }

     public function about(){
        $result = array(
            'page_header' => 'सम्पर्क',
        );
        return view('site.about', $result);
    }


    public function postContactUs(Request $request){
        if (!empty($request->all())) {
            $validator = Validator::make($request->all(),[
                'name'          => 'required',
                'address'       => 'required',
                'email'         => 'required',
                'message'       => 'required',
                'phoneno'       => 'required',
            ]);
            if ($validator->passes()) {
                $crud = new AdminContact;
                $crud->name = $request->name;
                $crud->email = $request->email;
                $crud->address = $request->address;
                $crud->phoneno = $request->phoneno;
                $crud->ip_address = $request->ip();
                $crud->message = $request->message;
                $crud->inserted_date = date('Y-m-d H:i:s');
                $crud->viewed = '0';
                $crud->status = '1';
                $crud->save();
                // Store your user in database
                $result = array(
                    'error'     => false,
                    'message'   => "Thank You for Contacting with Us !!!",
                );

                return response()->json($result,200);
            }else{
                $result = array(
                    'error'     => true,
                    'errors'    => $validator->errors()
                );
                return response()->json($result,200);
            }
        }else{
            $result = array(
                'error'     => true,
                'errors'    => 'Unauthorized Access',
            );
            return response()->json($result,200);
        }
    }

    public function categoryList($slug){
        $category = Home::getCategoryName($slug);
            // pe($category);
        if (!empty($category)) {
            
            $advertisementlist = Home::getAdvertisementList($type='nds1');
            
            if ($category->template_id == 1) {
                $list = Home::getPostListByCategoryId($category->id,$limit=9);
            }elseif ($category->template_id == 2) {
                $list = Home::getPostListByCategoryId($category->id,$limit=17);
            }elseif ($category->template_id == 3) {
                $list = Home::getPostListByCategoryId($category->id,$limit=16);
            }elseif ($category->template_id == 4) {
                $list = Home::getPostListByCategoryId($category->id,$limit=16);
            }elseif ($category->template_id == 5) {
                $list = Home::getPostListByCategoryId($category->id,$limit=12);
            }elseif ($category->template_id == 6) {
                $list = Home::getPostListByCategoryId($category->id,$limit=16);
            }elseif ($category->template_id == 7) {
                $list = Home::getPostListByCategoryId($category->id,$limit=9);
            }else{
                $list = Home::getPostListByCategoryId($category->id,$limit=13);
            }

            $result = array(
                'list'          => $list,
                'category'      => $category,
            );
            return view('site.category.'.$category->template_file, $result);
            
        } else {
            return view('errors.404');
        }
    }

    public function searchData(Request $request){
        if ($request->search != '') {
            $search = $request->search;
            $postlist = Home::getSearch('tbl_posts', $search);

            $result = array(
                'search'                => $search,
                'list'                  => $postlist,
                'page_header'           => 'Search',
            );
            // return $result;
            return view('site.searchlist', $result);
        } else {
            $postlist = Home::getSearch('tbl_posts', ' ');
            $result = array(
                'page_header'           => 'Search',
                'list'                  => $postlist,
                'search'                => '',
            );
            return view('site.searchlist', $result);
        }
    }

    public function changeTheme(Request $request){
        // return $request->all();
        session(['d_theme' => $request->id == 'dark__theme' ? 'dark__theme' : 'light__theme']);
        return response()->json($request->id." + ".session('d_theme'), 200);
    }

    public function trendingList($id){
        $detail = Home::getTrendingDataById($id);
        if (!empty($detail)) {
            $list = Home::getPostListByTrendId($detail->id);
            $result = array(
                'list'          => $list,
                'category'      => $detail,
            );
            return view('site.category.template_six', $result);
        }else{
            return view('errors.404');
        }
    }
    
}