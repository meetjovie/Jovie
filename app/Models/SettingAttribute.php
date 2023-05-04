<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_id',
        'user_id',
        'team_id',
        'user_list_id',
        'value',
        'type',
        'order'
    ];

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
}
