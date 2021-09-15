<?php

namespace App\Imports;

use App\Model\admin\AdminPosts;
use App\NewPosts;
use App\Post;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use DOMDocument;
use DOMXPath;

class PostImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        // $num =1;
        foreach($rows as $row){
            // $slugValue=$num++;
            // $ran=rand(10,100);
            // $final_slug=time().'-'.$slugValue.'-'.$ran;
            
            $html=$row['post_content']; 
                $doc=new DOMDocument();
                libxml_use_internal_errors(true);

                $doc->loadHTML($html);
                $xpath=new DOMXPath($doc);
                $src=$xpath->evaluate("string(//img/@src)");

                // dd($src);

                

            $insert_data[]=[
                'id'=>$row['id'],
                'published_date'=>$row['post_date'],
                'description'=>$row['post_content'],
                'title'=>$row['post_title'],
                'updated_at'=>$row['post_modified'],
                'slug'=>$row['id'],
                'show_image'=>'1',
                // 'image'=>$src,
                'guid'=>$row['guid'],

            ];
        }


        if(!empty($insert_data))
        {
           foreach($insert_data as $info){
               $rows[]=DB::table('tbl_posts')->insert($info);
           }        
        }

    }
}
