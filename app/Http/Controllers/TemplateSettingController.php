<?php

namespace App\Http\Controllers;

use App\Models\SettingAttribute;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\UserList;

class TemplateSettingController extends Controller
{
    public function index($userList)
    {
        $template = UserList::find($userList)->template->templateSettings;
        $templateSettings = $template->pluck('setting_id');
        $settings = array_filter(SettingAttribute::TEMPLATE_SETTINGS, function ($setting) use ($templateSettings) {
            return in_array($setting['id'], $templateSettings->toArray());
        });

        $user = auth()->user();
        $settingValues = SettingAttribute::where([
            'team_id' => $user->currentTeam->id,
            'user_id' => $user->id,
        ]);

        if ($userList) {
            $settingValues = $settingValues->where('user_list_id', $userList);
        }
        $settingValues = $settingValues->get()->toArray();

        $allSettings = [];
        foreach ($settings as $setting) {
            $data = array_filter($settingValues, function ($settingValue) use ($setting) {
                return $settingValue["setting_id"] == $setting["id"];
            });
            if (count($data)) {
                $setting['value'] = array_values($data)[0]['value'] == 0 ? true : false;
            }
            $allSettings[] = $setting;
        }
        return response()->json([
            'status' => true,
            'data' => $allSettings,
            'message' => 'Success'
        ], 200);
    }

    public function update(Request $request, $userList)
    {
        $data = $request->all();
        $user = auth()->user();
        SettingAttribute::updateOrCreate(
            [
                'team_id' => $user->currentTeam->id,
                'user_id' => $user->id,
                'setting_id' => $data['id'],
                'user_list_id' => $userList ?? null
            ],
            [
                'type' => $data['type'],
                'value' => $data['value'],
            ]
        );
        return response()->json([
            'status' => true,
            'message' => 'Successfully updated'
        ], 200);
    }
}
