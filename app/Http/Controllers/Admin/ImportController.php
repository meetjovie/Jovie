<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
    public function getColumnsFromCsv(Request $request)
    {
//        $request->validate([
//            'import' => 'required|mimes:csv'
//        ]);
        $headings = (new HeadingRowImport)->toArray($request->import);
        if (count($headings)) {
            return collect([
                'status' => true,
                'columns' => $headings[0][0],
            ]);
        }

        return collect([
            'status' => false,
            'columns' => $headings[0][0],
            'message' => 'No heading found.',
        ]);
    }
}
