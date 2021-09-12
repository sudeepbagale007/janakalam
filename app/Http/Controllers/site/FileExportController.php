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
        $info=DB::table('wp_posts')
                   ->where('post_type','post')
                   ->where('post_status','publish')
                   ->whereNull('wp_slug')
                   ->limit(100)
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
    
                    DB::table('wp_posts')
                        ->where('ID',$row->ID)
                        ->update([
                            'wp_slug'=>$slug
                        ]);
                }
            }
        }

        echo "Done";
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
}
