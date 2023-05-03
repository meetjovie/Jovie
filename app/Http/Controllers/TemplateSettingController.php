<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\UserList;

class TemplateSettingController extends Controller
{
    public function index($userList)
    {
        $template = UserList::find($userList)->template ?? Template::where('name', Template::DEFAULT_TEMPLATE_NAME)->first();
        $templateSettings = $template->templateSettings->toArray();
        return response()->json([
            'status' => true,
            'data' => $templateSettings,
            'message' => 'Success'
        ], 200);
    }

    public function update(Request $request, $userList)
    {
        $template = UserList::find($userList)->template ?? Template::where('name', Template::DEFAULT_TEMPLATE_NAME)->first();
        $templateSettings = $template->templateSettings();
        $templateSettings->where('key', $request->key)->update([
            'value' => $request->value,
            'visible' => $request->visible
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Successfully updated'
        ], 200);
    }
}
