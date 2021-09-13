<?php

namespace App\Exports;

use App\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $data=Post::select('post_date','post_content','post_title','post_modified','id')
        // ->where('post_status','publish')
        // ->where('post_type','post')
        // ->where('post_content','!=','')
        // ->get()
        // ->toArray();

        // foreach($data as $row){
        //     $secondData=TermTaxonomy::select('term_taxonomy_id')
        //                     ->where('id',$data->id)
        //                     ->get(); //28111

        //     foreach($secondData as $row1){
        //         $imp=implode(',',$secondData->term_taxnomy_id); //1,4,5
        //     }
            
        //     set($data['exp'])=$imp;
        // }


        // return $data;

        
        return Post::select('ID','post_date','post_content','post_title','post_modified','guid')
        ->where('post_status','publish')
        ->where('post_type','post')
        ->where('post_content','!=','')
        ->limit('10000')
        ->get();
    }

    public function headings() :array{
        return[
            'id',
            'post_date',
            'post_content',
            'post_title',
            'post_modified',
            'guid'
        ];
    }

}
