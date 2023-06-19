<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAttribute extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'setting_id',
        'user_id',
        'team_id',
        'user_list_id',
        'value',
        'type',
        'order'
    ];

    const DEFAULT_TEMPLATE_SETTINGS = [1,];

    const TEMPLATE_SETTINGS = [
        [
            'id' => 1,
            'name' => 'Show Follower Counts',
            'key' => 'show_follower_count',
            'icon' => 'UserGroupIcon',
            'type' => 'toggle',
            'value' => 0,
        ],
        [
            'id' => 2,
            'name' => 'Show Profile Pic',
            'key' => 'show_profile_pic',
            'icon' => 'UserGroupIcon',
            'type' => 'toggle',
            'value' => 0,
        ]
    ];


    public static function getSettings($userList = null)
    {
        $template = null;
        if ($userList) {
            $template = UserList::find($userList)->template->templateSettings;
            $templateSettings = $template->pluck('setting_id');
            $settings = array_filter(SettingAttribute::TEMPLATE_SETTINGS, function ($setting) use ($templateSettings) {
                return in_array($setting['id'], $templateSettings->toArray());
            });
        } else {
            $settings = SettingAttribute::getDefaultSettings();
        }

        $user = auth()->user();
        $settingValues = SettingAttribute::where([
            'team_id' => $user->currentTeam->id,
            'user_id' => $user->id,
        ]);

        $settingValues = $userList ? $settingValues->where('user_list_id', $userList) : $settingValues->whereNull('user_list_id');
        $settingValues = $settingValues->get()->toArray();

        $allSettings = [];
        foreach ($settings as $setting) {
            $data = array_filter($settingValues, function ($settingValue) use ($setting) {
                return $settingValue["setting_id"] == $setting["id"];
            });
            if (count($data)) {
                $setting['value'] = array_values($data)[0]['value'] == 0;
            }else if($template && $template->where('setting_id', $setting['id'])->first()){
                $setting['value'] =  $template->where('setting_id', $setting['id'])->first()->default_value;
            }
            $allSettings[] = $setting;
        }
        return $allSettings;
    }

    public static function updateSetting($user, $data, $userList = null)
    {
        return SettingAttribute::updateOrCreate(
            [
                'team_id' => $user->currentTeam->id,
                'user_id' => $user->id,
                'setting_id' => $data['id'],
                'user_list_id' => $userList
            ],
            [
                'value' => $data['value'],
            ]
        );
    }

    public static function getDefaultSettings()
    {
        $defaultSettings = SettingAttribute::DEFAULT_TEMPLATE_SETTINGS;
        return array_filter(SettingAttribute::TEMPLATE_SETTINGS, function ($SETTING) use ($defaultSettings) {
            return in_array($SETTING['id'], $defaultSettings);
        });
    }
}
