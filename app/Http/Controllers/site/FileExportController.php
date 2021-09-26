<?php

namespace App\Http\Controllers\site;

use App\Exports\CategoryExport;
use App\Exports\CategoryRelationExport;
use App\Http\Controllers\Controller;

use App\Exports\PostExport;
use App\Imports\CategoryImport;
use App\Imports\CategoryRelationImport;
use Illuminate\Http\Request;
use App\Imports\PostImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use DB;

class FileExportController extends Controller
{

    public function importExportView()
    {
        
        return view('import');
}
    
    public function export() 
    {
        return Excel::download(new PostExport, 'posts.xlsx');
    }

    public function import() 
    {
        Excel::import(new PostImport,request()->file('file'));
        session()->flash('success','Posts added Successful');
        return redirect()->back();
    }

    public function importCategoryView()
    {
        return view('importcategory');
    }

    public function exportCategory(){
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

    public function importCategory(){
        Excel::import(new CategoryImport,request()->file('file'));
        session()->flash('success','Category added Successful');
        return redirect()->back();
    }





    public function importCategoryRelView()
    {
        return view('importcategoryrel');
    }

    public function exportCategoryRel(){
        return Excel::download(new CategoryRelationExport, 'categoryrelation.xlsx');
    }

    public function importCategoryRel(){
        Excel::import(new CategoryRelationImport,request()->file('file'));
        session()->flash('success','CategoryRelation added Successful');
        return redirect()->back();
    }


    public function updateSlug()
    {
        $info=DB::table('tbl_posts')
                   ->where('slug',0)
                   ->limit(1)
                   ->get();
      
        $cc=new \GuzzleHttp\Client();

        foreach($info as $row){

            $abc=$cc->get($row->guid);

            $string= htmlspecialchars_decode($abc->getBody()->getContents());
    
            $doc = new \DOMDocument();
                    
            $doc->loadHTML($string,LIBXML_NOERROR);
            $xpath = new \DOMXPath( $doc );
    
    
            $nodes=$xpath->query('/html/head/meta[@name="twitter:url"]/@content');
    
    
            if($nodes->length==1)
            {
                for( $i = 0; $i < $nodes->length; $i++ ) {
                    $data= $nodes->item( $i )->value . PHP_EOL;
    
                    $slug=substr($data,30);
    
                    DB::table('tbl_posts')
                        ->where('id',$row->id)
                        ->update([
                            'slug'=>$slug
                        ]);
                }
            }
        }

        echo "Done";
    }

    // public function checking(){

    //     $data=DB::table('tbl_posts')
    //             ->whereNull('slug')
    //             ->get();

    //     $cc=new \GuzzleHttp\Client();

    //     foreach($data as $row){
    //         $link=$cc->get($row->guid);
    //         $string= htmlspecialchars_decode($link->getBody()->getContents());
    //         $doc = new \DOMDocument();
    //         $doc->loadHTML($string,LIBXML_NOERROR);
    //         $xpath = new \DOMXPath( $doc );
    //         $nodes=$xpath->query('/html/head/meta[@property="og:url"]/@content');

    //         if($nodes->length==1){
    //             for( $i = 0; $i < $nodes->length; $i++ ) {
    //                 $data= $nodes->item( $i )->value . PHP_EOL;
    //                 $exp=explode('/',$data);
    //                 $slug=$exp[3];
                    
    //                 DB::table('tbl_posts')
    //                     ->where('id',$row->id)
    //                     ->update([
    //                         'slug'=>$slug
    //                     ]);  
    //             }
    //         }
    //     }
    //     echo "Done Slug";   
    // }

    // public function imageGet(){

    //     $data=DB::table('tbl_posts')
    //             ->select()
    //             ->whereNull('image')
    //             ->get();

    //     foreach($data as $row){

    //         $cc=new \GuzzleHttp\Client();
    //         $abc=$cc->get($row->guid);
    //         $string= htmlspecialchars_decode($abc->getBody()->getContents());
    //         $doc = new \DOMDocument();
    //         $doc->loadHTML($string,LIBXML_NOERROR);
    //         $xpath = new \DOMXPath( $doc );
    //         $nodes = $xpath->query( "//div[contains(@class,'image landscape')]//@src" );
    //         $nodes1 = $xpath->query( "//div[contains(@class,'featured-image')]//@src" );

    //         if($nodes->length==1)
    //         {
    //             for( $i = 0; $i < $nodes->length; $i++ ) {
    //                 $new=DB::table('tbl_posts')
    //                         ->where('id',$row->id)
    //                         ->update([
    //                             'guid'=>$nodes->item( $i )->value . PHP_EOL
    //                         ]);
    //             }
    //         }
    //         if($nodes1->length==1){
    //             for( $i = 0; $i < $nodes1->length; $i++ ) {
    //                 $new=DB::table('tbl_posts')
    //                 ->where('id',$row->id)
    //                 ->update([
    //                     'image'=>$nodes1->item( $i )->value . PHP_EOL
    //                 ]);
    //             }
    //         }
    //     }

    //     echo  "done";
    // }
}
