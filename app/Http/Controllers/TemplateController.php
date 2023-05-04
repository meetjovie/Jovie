<?php

namespace App\Http\Controllers;

use App\Models\Template;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all()->toArray();
        return response()->json([
            'status' => true,
            'data' => $templates,
            'message' => 'Success'
        ], 200);
    }
}
