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
        foreach($rows as $row){
            $insert_data[]=[
                'published_date'=>$row['post_date'],
                'description'=>$row['post_content'],
                'title'=>$row['post_title'],
                'updated_at'=>$row['post_modified'],
            ];
        }


        if(!empty($insert_data))
        {
           foreach($insert_data as $info){
               $rows[]=DB::table('new_posts')->insertGetId($info);
           }        
        }

        foreach($rows as $id){
            if(is_int($id)){
                $new_id[]=$id;
            }
        }
       
        // foreach($created_datas as  $datas)
        //     DB::table('rel_post_category')->insert([
        //             'post_id' => $datas->id,
        //             'category_id'=>'2',
        //     ]);
    }
}
