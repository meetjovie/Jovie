<?php

namespace Database\Seeders;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use App\Models\Template;
use App\Models\TemplateField;
use App\Models\TemplateSetting;
use App\Models\TemplateStage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        $template = Template::create([
            'name' => Template::DEFAULT_TEMPLATE_NAME,
            'description' => 'the default template of jovie lists',
        ]);

        $stages = [
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

        foreach ($stages as $stage) {
            TemplateStage::create([
                'template_id' => $template->id,
                'name' => $stage['name'],
                'color' => $stage['color'],
                'order' => $stage['order'],
            ]);
        }

        TemplateSetting::create([
            'template_id' => $template->id,
            'name' => 'Show Follower Counts',
            'key' => 'show_follower_count',
            'icon' => 'UserGroupIcon',
            'visible' => true,
            'type' => 'toggle',
            'value' => 1,
        ]);

        foreach (FieldAttribute::DEFAULT_FIELDS as $FIELD) {
            TemplateField::create(
                [
                    'template_id' => $template->id,
                    'field_id' => $FIELD['id'],
                ]
            );
        }

        $customField = CustomField::create(
            [
                'user_id' => 1,
                'team_id' => 1,
                'name' => 'CustomField',
                'code' => 'custom_feild',
                'description' => 'Custom feild for testing',
                'type' => 'text',
            ]
        );

        TemplateField::create(
            [
                'template_id' => $template->id,
                'field_id' => $customField->id,
            ]
        );

    }
}
