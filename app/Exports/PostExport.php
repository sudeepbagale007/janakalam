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
        return Post::select('post_date','post_content','post_title','post_modified')
        ->limit('10')
        ->where('post_status','publish')
        ->where('post_type','post')
        ->get();
    }

    public function headings() :array{
        return[
            'post_date',
            'post_content',
            'post_title',
            'post_modified'
        ];
    }

}
