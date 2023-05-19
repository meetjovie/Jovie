<?php

namespace Database\Seeders;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use App\Models\HeaderAttribute;
use App\Models\SettingAttribute;
use App\Models\Template;
use App\Models\TemplateField;
use App\Models\TemplateHeader;
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

        foreach (SettingAttribute::getDefaultSettings() as $SETTING) {
            TemplateSetting::create([
                'template_id' => $template->id,
                'setting_id' => $SETTING['id'],
            ]);
        }

        foreach (HeaderAttribute::DEFAULT_HEADERS as $HEADER) {
            TemplateHeader::create([
                'template_id' => $template->id,
                'header_id' => $HEADER['id'],
            ]);
        }

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



        $template = Template::create([
            'name' => 'Custom Wala',
            'description' => 'the default template of jovie lists',
        ]);

        $stages = [
            [
                'name' => 'Lead1',
                'color' => '#6366F1',
                'order' => 0,
            ],
            [
                'name' => 'Interested1',
                'color' => '#22C55E',
                'order' => 1,
            ],
            [
                'name' => 'Negotiating1',
                'color' => '#3B82F6',
                'order' => 2,
            ],
            [
                'name' => 'In Progress1',
                'color' => '#EC4899',
                'order' => 3,
            ],
            [
                'name' => 'Complete1',
                'color' => '#A855F7',
                'order' => 4,
            ],
            [
                'name' => 'Not Interested1',
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
                'setting_id' => 2,
            ]);

        foreach (HeaderAttribute::DEFAULT_HEADERS as $HEADER) {
            if(!in_array($HEADER['id'], [4,3,5])) {
                TemplateHeader::create([
                    'template_id' => $template->id,
                    'header_id' => $HEADER['id'],
                ]);
            }
        }

        foreach (FieldAttribute::DEFAULT_FIELDS as $FIELD) {
            if(!in_array($FIELD['id'], [4, 2, 5])){
                TemplateField::create(
                    [
                        'template_id' => $template->id,
                        'field_id' => $FIELD['id'],
                    ]
                );
            }
        }

        $customField = CustomField::create(
            [
                'user_id' => 1,
                'team_id' => 1,
                'name' => 'CustomField'.'113',
                'code' => 'custom_feild'.'113',
                'description' => 'Custom feild for testing'.'113',
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
