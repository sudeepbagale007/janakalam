<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use PrintHelper;


class AdminAjaxController extends Controller
{

    public function postDragDropSorting()
    {
        PrintHelper::dragDropSorting();
    }

    public function postUpdateField()
    {
        PrintHelper::updateField();
    }

}
