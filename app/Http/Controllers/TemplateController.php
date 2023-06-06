<?php

namespace App\Http\Controllers;

use App\Models\Template;
use http\Env\Request;

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

    public function setTemplate(Request $request)
    {
        $data = $request->all();
        $template = Template::find($data['template_id']);
        return response()->json([
            'status' => true,
            'data' => $template,
            'message' => 'Success'
        ], 200);
    }
}
