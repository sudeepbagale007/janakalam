<?php

namespace App\Exports;

use App\OldCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CategoryExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OldCategory::select('term_id','name','slug')->get();

    }

    public function headings() :array{
        return[
            'category_id',
            'category_name',
            'category_slug'
        ];
    }
}
