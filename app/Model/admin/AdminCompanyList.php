<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AdminCompanyList extends Model {

    protected $table = 'tbl_company_list';
    protected $guarded = ['id'];

    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    

    public function posts(){
        $data = $this->belongsToMany(AdminNews::class, 'rel_post_companyname');
        return $data;
    }

    public function events(){
        $data = $this->belongsToMany(AdminEvents::class, 'rel_events_companyname');
        return $data;
    }

    public function registrar(){
        $data = $this->belongsToMany(AdminShareRegistrar::class, 'rel_company_shareregistrar');
        return $data;
    }

    public function mutualfund() {
        return $this->hasOne(AdminMutualFundDetail::class,'mutualfund_id');
    }

    public function mutualfundnav() {
        return $this->hasOne(AdminMutualFundNav::class,'mutualfund_id');
    }

    public function dividend() {
        return $this->hasOne(AdminDividendHistory::class,'companyid');
    }
    
    public static function deleteCompanyNewsId($id){
        $data =  DB::table('rel_post_companyname')
                -> where('admin_company_list_id', $id)
                -> delete();
        return $data;
    }
}
