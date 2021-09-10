<?php

namespace App\Exports;

use App\OldCategoryRelationShip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CategoryRelationExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return OldCategoryRelationShip::select('object_id','term_taxonomy_id')->get();
    }

    public function headings() :array{
        return[
            'post_id',
            'category_id',
        ];
    }
}
