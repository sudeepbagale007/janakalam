<?php

namespace App\Imports;

use App\Model\admin\AdminPosts;
use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class PostImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AdminPosts([
                'published_date'=>$row[0],
                'description'=>$row[1],
                'title'=>$row[2],
                'created_at'=>$row[3],
                'slug'=>$row[4],
                

        ]);
    }
}
