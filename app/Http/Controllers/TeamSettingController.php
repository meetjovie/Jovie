<?php

namespace App\Http\Controllers;

use App\Models\TeamSetting;
use Illuminate\Http\Request;

class TeamSettingController extends Controller
{
    public function index()
    {
        $allSettings = TeamSetting::getAllTeamSettings();
        return response()->json([
            'status' => true,
            'data' => $allSettings,
        ]);
    }

    public function update(Request $request)
    {
        $updatedSettings = $request->teamSettings;

        foreach ($updatedSettings as $key => $value) {
            TeamSetting::setSetting($key, $value['value'] ?? $value['default']);
        }

        return response()->json([
            'status' => true,
            'data' => $updatedSettings,
        ]);
    }
}
