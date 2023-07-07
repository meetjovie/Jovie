<?php

namespace App\Http\Controllers;

use App\Models\SettingAttribute;
use Illuminate\Http\Request;

class TemplateSettingController extends Controller
{
    public function index($userList)
    {
        $userList = $userList == 'null' ? null : $userList;
        $settings = SettingAttribute::getSettings($userList);

        return response()->json([
            'status' => true,
            'data' => $settings,
            'message' => 'Success'
        ], 200);
    }

    public function update(Request $request, $userList)
    {
        $data = $request->all();
        $user = auth()->user();
        $userList = $userList == 'null' ? null : $userList;
        SettingAttribute::updateSetting($user, $data, $userList);

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated'
        ], 200);
    }
}
