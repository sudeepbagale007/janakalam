<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\site\BasicController;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'site'], function (){
	Route::get('album', 'HomeController@albumData')->name('album');
	Route::get('album/{slug}', 'HomeController@albumSingle')->name('albumSingle');


Route::get('/c', function() {
    $exitCode = Artisan::call('cache:clear');
    Artisan::call('config:clear');
    // $exitCode = Artisan::call('optimize');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return "All cleared";
});

	Route::get('/', 'HomeController@index')->name('index');
	Route::get('pages/{slug}', 'HomeController@pagesDetail' )->name('page.detail');
	Route::get('{Slug}', 'HomeController@postDetail' )->name('post.detail');
	Route::get('faq', 'HomeController@faqData')->name('faq');
	Route::get('video', 'HomeController@videoData')->name('video');
	Route::get('contact-us', 'HomeController@contactUs')->name('contact');
	Route::get('unicode', 'HomeController@unicode')->name('unicode');
	Route::get('about', 'HomeController@about')->name('about');
	Route::get('about-group', 'HomeController@aboutGroup')->name('about-group');

	Route::post('contact-us', 'HomeController@postContactUs')->name('post.contact');
	Route::get('category/{slug}', 'HomeController@categoryList' )->name('category.list');
	Route::get('trend/{slug}', 'HomeController@trendingList' )->name('trending.list');
	Route::any('search', 'HomeController@searchData')->name('search');
	Route::any('changetheme', 'HomeController@changeTheme')->name('changetheme');

	Route::get('share-calculator', 'BasicController@shareCalculator');
	Route::get('calculator/right-share-adjustment', 'BasicController@rightShareAdjustmentCalculator');
	Route::get('calculator/bonus-share-adjustment', 'BasicController@bonusShareAdjustmentCalculator');

	Route::get('brokerlist', 'BasicController@brokerList');
	Route::get('dp-memberlist', 'BasicController@dpMemberList');
	Route::get('iporesult', 'BasicController@ipoResult')->name('iporesult');
	Route::post('iporesult', 'BasicController@ipoResultData')->name('postiporesult');

	Route::get('mutual-fund-nav', 'BasicController@mutualFund')->name('mutualfund');
	Route::any('ajaxmutualfundchart', 'BasicController@ajaxMutualFundChart')->name('ajaxmutualfundchart');
	
	// Route::get('investment', 'InvestmentController@investment')->name('investment');
	Route::get('todayshareprice', 'BasicController@todaySharePrice')->name('todayshareprice');

	Route::any('updatereaction','BasicController@updateReaction')->name('updatereaction');

	Route::post('add-post-comment','PostCommentsController@addPostComment')->name('addComment');
	Route::post('save-janamat-answer','BasicController@saveUseranswer')->name('save-janamat-answer');
	Route::get('export', 'FileExportController@export')->name('export');
	Route::get('importExportView', 'FileExportController@importExportView');
	Route::post('import', 'FileExportController@import')->name('import');

	Route::post('updateinteraction','BasicController@updateCommentInteraction')->name('updateinteraction');

	Route::get('importCategoryView', 'FileExportController@importCategoryView');
	Route::post('importcategory', 'FileExportController@importCategory')->name('importcategory');
	Route::get('exportcategory', 'FileExportController@exportCategory')->name('exportcategory');


	Route::get('importCategoryRelView', 'FileExportController@importCategoryRelView');
	Route::post('importcategoryrel', 'FileExportController@importCategoryRel')->name('importcategoryrel');
	Route::get('exportcategoryrel', 'FileExportController@exportCategoryRel')->name('exportcategoryrel');


});


// Admin Web Route
Route::group(['prefix' => 'my-admin','namespace' => 'admin'], function (){
	Route::get('login', 'AdminLoginController@login')->name('login.page');
	Route::post('login', 'AdminLoginController@loginCheck')->name('login');
});


Route::group(['prefix' => 'u-admin', 'namespace' => 'admin', 'middleware'   => ['adminlogincheck','roles']], function (){
	Route::get('registeruser', 'AdminLoginController@userRegister')->name('user.create');
	Route::post('registeruser', 'AdminLoginController@userRegisterData')->name('userregister');
	Route::get('/', 'AdminLoginController@dashboard')->name('dashboard');
	Route::get('dashboard', 'AdminLoginController@dashboard')->name('dashboard');
	Route::get('user/list', 'AdminLoginController@adminUserList')->name('user.list');
	Route::get('user/{id}/edit', 'AdminLoginController@editUser')->name('user.edit');
	Route::any('updateuser/{id}', 'AdminLoginController@updateuser')->name('user.update');
	Route::get('user/delete/{id}', ['as' => 'user.delete', 'uses' => 'AdminLoginController@deleteUser']);
	Route::any('logout', 'AdminLoginController@logout')->name('logout');

	// reports
	Route::get('topviews-data', 'AdminDashboardController@topViewsData')->name('chart.topviewsdata');
	Route::get('topviewsjson', 'AdminDashboardController@topViewsJson')->name('topviewsjson');

	// author wise news
	Route::get('author-data', 'AdminDashboardController@authorData')->name('chart.authordata');
	Route::get('authorjson', 'AdminDashboardController@authorJson')->name('authorjson');

	// category wise news
	Route::get('category-data', 'AdminDashboardController@categoryData')->name('chart.categorydata');
	Route::get('categoryjson', 'AdminDashboardController@categoryJson')->name('categoryjson');



	Route::any('updateuserprofile/{id}', 'AdminProfileController@updateuser')->name('userprofile.update');
	Route::get('userprofile', 'AdminProfileController@editUserProfile')->name('userprofile.editprofile');

	Route::get('ui-skin', 'AdminUIComponentController@uiManagement')->name('ui_skin.index');
	Route::get('ui-skin-change/{id}', 'AdminUIComponentController@uiSkinChange')->name('ui_skin.change');

	Route::get('success-login', 'AdminLoginLogsController@successLogin')->name('successlogin');
	Route::get('fail-login', 'AdminLoginLogsController@failLogin')->name('faillogin');
	Route::get('menu', 'AdminMenuController@index')->name('menu');
	// User Group
	Route::resource('usergroup', 'AdminGroupController');
	Route::get('usergroup/delete/{id}', ['as' => 'usergroup.delete', 'uses' => 'AdminGroupController@destroy']);
	// Role Access
	Route::resource('role-access', 'AdminRoleAccessController');
	Route::get('role-access/delete/{id}', ['as' => 'role-access.delete', 'uses' => 'AdminRoleAccessController@destroy']);
    Route::get('roleChangeAccess/{allowId}/{id}','AdminRoleAccessController@changeAccess');
    Route::get('setting','AdminSiteSettingController@setting')->name('setting');
    Route::post('setting-update','AdminSiteSettingController@updateSetting')->name('update.setting');

    // pages
	Route::resource('pages', 'AdminPagesController');
	Route::get('pages/delete/{id}', ['as' => 'pages.delete', 'uses' => 'AdminPagesController@destroy']);
	
	// category
	Route::resource('category', 'AdminCategoryController');
	Route::get('category/delete/{id}', ['as' => 'category.delete', 'uses' => 'AdminCategoryController@destroy']);
	
	// posts
	// Route::get('posts/migrate', ['as' => 'posts.migrate', 'uses' => 'AdminPostsController@migrateData']);
	Route::resource('posts', 'AdminPostsController');
	Route::get('posts/delete/{id}', ['as' => 'posts.delete', 'uses' => 'AdminPostsController@destroy']);

	// author
	Route::resource('author', 'AdminAuthorController');
	Route::get('author/delete/{id}', ['as' => 'author.delete', 'uses' => 'AdminAuthorController@destroy']);
	
	// advertisement
	Route::resource('advertisement', 'AdminAdvertisementController');
	Route::get('advertisement/delete/{id}', ['as' => 'advertisement.delete', 'uses' => 'AdminAdvertisementController@destroy']);

	// video
	Route::resource('video', 'AdminVideoController');
	Route::get('video/delete/{id}', ['as' => 'video.delete', 'uses' => 'AdminVideoController@destroy']);

	// video
	Route::resource('tag', 'AdminTagController');
	Route::get('tag/delete/{id}', ['as' => 'tag.delete', 'uses' => 'AdminTagController@destroy']);

	// faq
	Route::resource('faq', 'AdminFaqController');
	Route::get('faq/delete/{id}', ['as' => 'faq.delete', 'uses' => 'AdminFaqController@destroy']);

	// livevideo
	Route::resource('livevideo', 'AdminLiveVideoController');
	Route::get('livevideo/delete/{id}', ['as' => 'livevideo.delete', 'uses' => 'AdminLiveVideoController@destroy']);

	// Contact
	Route::resource('contact', 'AdminContactController');
	Route::get('contact/delete/{id}', ['as' => 'contact.delete', 'uses' => 'AdminContactController@destroy']);

	// faqlist
	Route::resource('faqlist', 'AdminFaqListController');
	Route::get('faqlist/delete/{id}', ['as' => 'faqlist.delete', 'uses' => 'AdminFaqListController@destroy']);

	Route::get('medialibrary', 'AdminDashboardController@mediaLibrary')->name('medialibrary');
	Route::any('ajax/drag-drop-sorting', 'AdminAjaxController@postDragDropSorting')->name('ajax.sorting');


	// faqlist
	Route::resource('video-post', 'AdminVideoPostController');
	Route::get('video-post/delete/{id}', ['as' => 'video-post.delete', 'uses' => 'AdminVideoPostController@destroy']);



	// Album
	Route::resource('album', 'AlbumController');
	Route::get('album/delete/{id}', ['as' => 'album.delete', 'uses' => 'AlbumController@destroy']);
	Route::get('/album/gallery/{id}','AlbumController@albumGallery')->name('albumGallery');
	Route::get('/album/gallery/status/{id}','AlbumController@albumGalleryStatus')->name('albumGalleryStatus');
	Route::get('/album/gallery/delete/{id}','AlbumController@albumGalleryDelete')->name('albumGalleryDelete');
	Route::get('/album/gallery/Edit/{albumId}/{id}','AlbumController@albumGalleryEdit')->name('albumGalleryEdit');
	Route::post('/album/gallery/update/{id}','AlbumController@albumGalleryUpdate')->name('albumGalleryUpdate');
	Route::Post('album/galleryStore/{id}','AlbumController@galleryStore')->name('galleryStore');

	Route::resource('janamat', 'AdminJanamatController');
	Route::get('janamat/delete/{id}', ['as' => 'janamat.delete', 'uses' => 'AdminJanamatController@destroy']);
	Route::get('user-answer/{id}','AdminJanamatController@viewUserAnswer')->name('user-answer');

});
