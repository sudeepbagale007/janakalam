<?php

namespace App\Providers;

use App\Model\admin\AdminSetting;
use App\Model\admin\AdminUser;
use App\Model\site\Home;
use Harimayco\Menu\Facades\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Request;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
        view()->composer('site.*',function($view) {
            $d_theme = (session('d_theme') != '')?session('d_theme'):'light__theme';
            $sitedetail = AdminSetting::findorfail('1');
            $primarymenu = Menu::get(1);
            $quicklinks = Menu::get(2);
            $news = Menu::get(3);
            $relatedsite = Menu::get(4);
            $quicklinks_name = AdminSetting::getMenuName(2);
            $relatedsite_name = AdminSetting::getMenuName(4);
            $latest = Home::getAllLatestPostList($limit=6);


            $topheaderad_1 = Home::getAdvertisement($type='th1');
            
            
            $advertisement = array(
                'topheaderad_1'     => $topheaderad_1,
            );

            $menulist = array(
                'primarymenu'           => $primarymenu,
                'quicklinks'            => $quicklinks,
                'relatedsite'           => $relatedsite,
                'news'                  => $news,
                'quicklinks_name'       => isset($quicklinks_name)?$quicklinks_name->name:'-',
                'relatedsite_name'      => isset($relatedsite_name)?$relatedsite_name->name:'-',
            );

            
            $view->with('latest', $latest);
            $view->with('menulist', $menulist);
            $view->with('sitedetail', $sitedetail);
            $view->with('advertisement', $advertisement);
            $view->with('d_theme', $d_theme);
        });
        view()->composer('admin.*',function($view) {
            $sitedetail = AdminSetting::findorfail('1');
            $adminuserdetail = AdminUser::getAdminUserDetail();
            $view->with('sitedetail', $sitedetail);
            $view->with('adminuserdetail', $adminuserdetail);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){
        //
        // require_once __DIR__ . '/../Helper/printhelper.php';
    }
}
