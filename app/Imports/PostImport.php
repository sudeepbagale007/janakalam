<?php

namespace App\Imports;

use App\Model\admin\AdminPosts;
use App\NewPosts;
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
        dd($row[0]);
        return new NewPosts([
                'published_date'=>$row[0],
                'description'=>$row[1],
                'title'=>$row[2],
                'updated_at'=>$row[3],
        ]);
    }
}
