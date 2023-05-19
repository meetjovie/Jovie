<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'team_id',
        'name',
        'description',
        'icon',
    ];

    const DEFAULT_TEMPLATE_STAGES = [
        [
            'name' => 'Lead',
            'color' => '#6366F1',
            'order' => 0,
        ],
        [
            'name' => 'Interested',
            'color' => '#22C55E',
            'order' => 1,
        ],
        [
            'name' => 'Negotiating',
            'color' => '#3B82F6',
            'order' => 2,
        ],
        [
            'name' => 'In Progress',
            'color' => '#EC4899',
            'order' => 3,
        ],
        [
            'name' => 'Complete',
            'color' => '#A855F7',
            'order' => 4,
        ],
        [
            'name' => 'Not Interested',
            'color' => '#EF4B4B',
            'order' => 5,
        ],
    ];

    const DEFAULT_TEMPLATE_SETTINGS = [
        [
            'name' => 'Show Follower Counts',
            'key' => 'show_follower_count',
            'icon' => 'UserGroupIcon',
            'visible' => true,
            'type' => 'toggle',
            'value' => 1,
        ]
    ];

    const DEFAULT_TEMPLATE_NAME = 'Default';

//    public function createTemplate($templateDetails, $settings, $stages, $fields)
//    {
//        $template = Template::create([
//            'name' => $templateDetails['name'],
//            'description' => $templateDetails['description'],
//        ]);
//
//        foreach ($stages as $stage) {
//            TemplateStage::create([
//                'template_id' => $template->id,
//                'name' => $stage['name'],
//                'color' => $stage['color'],
//                'order' => $stage['order'],
//            ]);
//        }
//
//        foreach ($settings as $setting) {
//            TemplateSetting::create([
//                'template_id' => $template->id,
//                'name' => $setting['name'],
//                'key' => $setting['key'],
//                'icon' => $setting['icon'],
//                'visible' => $setting['visible'],
//                'type' => $setting['type'],
//                'value' => $setting['value'],
//            ]);
//        }
//        foreach ($fields as $field) {
//            TemplateField::create(
//                [
//                    'template_id' => $template->id,
//                    'field_id' => $field['id'],
//                ]
//            );
//        }
//
//        return $template;
//    }
//
//    public function setupUserListTemplate($template, $userList = null)
//    {
//        $user = auth()->user();
//        $teamId = $user->currentTeam->id;
//
//        if ($userList) {
//            $user = $userList->user ?? $user;
//            $teamId = $userList->team_id ?? $teamId;
//        }
//
//        $userListTemplate = Template::create([
//            'name' => $template['name'],
//            'user_id' => $user->id,
//            'team_id' => $teamId,
//            'description' => $template['description'],
//        ]);
//
//        foreach ($template->stages as $stage) {
//            TemplateStage::create([
//                'template_id' => $userListTemplate->id,
//                'user_id' => $user->id,
//                'team_id' => $teamId,
//                'name' => $stage['name'],
//                'color' => $stage['color'],
//                'order' => $stage['order'],
//            ]);
//        }
//
//        foreach ($template->settings as $setting) {
//            TemplateSetting::create([
//                'template_id' => $userListTemplate->id,
//                'user_id' => $user->id,
//                'team_id' => $teamId,
//                'name' => $setting['name'],
//                'key' => $setting['key'],
//                'icon' => $setting['icon'],
//                'visible' => $setting['visible'],
//                'type' => $setting['type'],
//                'value' => $setting['value'],
//            ]);
//        }
//
//        foreach ($template->fields as $field) {
//            TemplateField::create(
//                [
//                    'user_id' => $user->id,
//                    'team_id' => $teamId,
//                    'template_id' => $userListTemplate->id,
//                    'field_id' => $field['id'],
//                ]
//            );
//        }
//
//        $userList->template_id = $userListTemplate->id;
//        $userList->save();
//
//        return $userListTemplate;
//    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function templateSettings()
    {
        return $this->hasMany(TemplateSetting::class);
    }

    public function templateStages()
    {
        return $this->hasMany(TemplateStage::class);
    }

    public function templateHeaders()
    {
        return $this->hasMany(TemplateHeader::class);
    }

    public function templateFields()
    {
        return $this->hasMany(TemplateField::class);
    }
}
