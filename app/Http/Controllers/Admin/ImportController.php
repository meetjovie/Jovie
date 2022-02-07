<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function getColumnsFromCsv(Request $request)
    {
        return [
            'name',
            'email',
            'social'
        ];
    }
}
