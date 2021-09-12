<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class CategoryImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
            foreach($collection as $row){
                $ran=rand(1,4);
                $insert_data[]=[
                    'id'=>$row['category_id'],
                    'title'=>$row['category_name'],
                    'slug'=>$row['category_slug'],
                    'template_id'=>$ran,
                    'status'=>1,
                    'parent_id'=>0,
                  
                ];
            }
    
    
            if(!empty($insert_data))
            {
               foreach($insert_data as $info){
                   $rows[]=DB::table('tbl_category')->insertGetId($info);
               }        
            }
            
    }
}
