<?php

namespace App\Http\Controllers\site;
use App\Http\Controllers\Controller;

use App\Exports\PostExport;
use Illuminate\Http\Request;
use App\Imports\PostImport;
use Maatwebsite\Excel\Facades\Excel;

class FileExportController extends Controller
{

    public function importExportView()
    {
       return view('import');
    }
    
    public function export() 
    {
        return Excel::download(new PostExport, 'posts.xlsx');
    }

    public function import() 
    {
        Excel::import(new PostImport,request()->file('file'));
        session()->flash('success','Posts added Successful');
        return redirect()->back();
    }
}
