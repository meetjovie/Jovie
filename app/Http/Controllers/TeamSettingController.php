<?php

namespace App\Http\Controllers;

use App\Models\TeamSetting;
use Illuminate\Http\Request;

class TeamSettingController extends Controller
{
    public function index(){
        $settingKeys = TeamSetting::SETTING_KEYS;
        $teamSettings = TeamSetting::whereIn('key', $settingKeys)
            ->select(['key', 'value'])
            ->get()->toArray();

        $teamKeys = [];
        foreach ($teamSettings as $teamSetting){
            $teamKeys[] = $teamSetting['key'];
        }

        foreach ($settingKeys as $settingKey){
            if(!in_array($settingKey, $teamKeys)){
                $teamSettings[] = [
                    'key' => $settingKey,
                    'value' => ''
                ];
            }
        }

        return response()->json([
            'status' => true,
            'data' => $teamSettings,
        ]);
    }

    public function update(Request $request){
        $updatedSettings = $request->teamSettings;
        foreach ($updatedSettings as $updatedSetting){
            TeamSetting::setSetting($updatedSetting['key'], $updatedSetting['value']);
        }
        return response()->json([
            'status' => true,
            'data' => $updatedSettings,
        ]);
    }
}
