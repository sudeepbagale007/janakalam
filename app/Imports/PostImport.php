<?php

namespace App\Imports;

use App\Model\admin\AdminPosts;
use App\NewPosts;
use App\Post;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class PostImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $num =1;
        foreach($rows as $row){
            $slugValue=$num++;
            $ran=rand(10,100);
            $final_slug=time().'-'.$slugValue.'-'.$ran;
            
            $insert_data[]=[
                'published_date'=>$row['post_date'],
                'description'=>$row['post_content'],
                'title'=>$row['post_title'],
                'updated_at'=>$row['post_modified'],
                'data_type'=>'0',
                'slug'=>$final_slug
            ];
        }


        if(!empty($insert_data))
        {
           foreach($insert_data as $info){
               $rows[]=DB::table('tbl_posts')->insertGetId($info);
           }        
        }

        foreach($rows as $id){
            if(is_int($id)){
                $new_ids[]=$id;
            }
        }
       
        foreach($new_ids as  $datas){   
                     DB::table('rel_post_category')->insert([
                    'post_id' => $datas,
                    'category_id'=>'2',
        
            ]);
        }
    }
}
