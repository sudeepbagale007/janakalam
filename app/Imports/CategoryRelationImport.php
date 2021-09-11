<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
class CategoryRelationImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
            $insert_data[]=[
                'post_id'=>$row['post_id'],
                'category_id'=>$row['category_id'],
            ];
        }

        // $needed_post = DB::table('tbl_posts')->slelect('id')->get();
        if(!empty($insert_data))
        {
           foreach($insert_data as $info){
               $rows[]=DB::table('rel_post_category')->insert($info);
           }        
        }
        

    }
}
