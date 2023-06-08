<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\UserList;
use Illuminate\Http\Request;

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
        $data = $request->validate([
            'list_id' => 'required|integer',
            'template_id' => 'required',
        ]);

        $template = UserList::setTemplate($data['list_id'], $data['template_id']);

        if ($template) {
            return response()->json([
                'status' => true,
                'data' => $template,
                'message' => 'List template successfully updated.'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'data' => null,
            'message' => "Couldn't update list template"
        ], 403);
    }
}
