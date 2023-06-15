<?php

namespace Database\Seeders;

use App\Models\CustomField;
use App\Models\CustomFieldOption;
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

        // Default Template
        $template = Template::create([
            'name' => Template::DEFAULT_TEMPLATE_NAME,
            'icon' => '🤗',
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

        $ignored = HeaderAttribute::IGNORED_DEFAULT_HEADERS;
        foreach (array_filter(HeaderAttribute::DEFAULT_HEADERS, function ($header) use ($ignored) {
                     return !in_array($header['id'], $ignored);
                 }) as $HEADER) {
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

        // Template # 1
        $template = Template::create([
            'name' => 'Influencer Outreach',
            'icon' => '👥',
            'description' => 'Influencer outreach template by Jovie',
        ]);

        $stages = [
            [
                'name' => 'Contacted',
                'color' => '#94a3b8',
                'order' => 0,
            ],
            [
                'name' => 'Not yet contacted',
                'color' => '#94a3b8',
                'order' => 1,
            ],
            [
                'name' => 'Interested',
                'color' => '#22c55e',
                'order' => 2,
            ],
            [
                'name' => 'Not Interested',
                'color' => '#ef4b4b',
                'order' => 3,
            ],
            [
                'name' => 'Negotiating',
                'color' => '#f7eb5a',
                'order' => 4,
            ],
            [
                'name' => 'Need more info',
                'color' => '#f7eb5a',
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

        foreach (HeaderAttribute::DEFAULT_HEADERS as $HEADER) {
            if (in_array($HEADER['id'], [7, 8, 5, 9, 15])) {
                TemplateHeader::create([
                    'template_id' => $template->id,
                    'header_id' => $HEADER['id'],
                ]);
            }
        }

        foreach (FieldAttribute::DEFAULT_FIELDS as $FIELD) {
            if (in_array($FIELD['id'], [4, 2, 5])) {
                TemplateField::create(
                    [
                        'template_id' => $template->id,
                        'field_id' => $FIELD['id'],
                    ]
                );
            }
        }

        $customFields = [
            [
                'name' => 'Closing Price',
                'code' => 'closing_price',
                'description' => 'Closing price for influencer outreach',
                'icon' => 'CurrencyDollarIcon',
                'type' => 'currency',
            ]
        ];

        foreach ($customFields as $customField) {
            $field = CustomField::create(
                [
                    'user_id' => 1,
                    'team_id' => 1,
                    'name' => $customField['name'],
                    'code' => $customField['code'],
                    'description' => $customField['description'],
                    'type' => $customField['type'],
                ]
            );
            TemplateHeader::create([
                'template_id' => $template->id,
                'header_id' => $field->id,
            ]);

            TemplateField::create(
                [
                    'template_id' => $template->id,
                    'field_id' => $field->id,
                ]
            );
        }


        // Template # 2
        $template = Template::create([
            'name' => 'Sales',
            'icon' => '💹',
            'description' => 'Sales template by Jovie',
        ]);

        $stages = [
            [
                'name' => 'Contacted',
                'color' => '#94a3b8',
                'order' => 0,
            ],
            [
                'name' => 'Not yet contacted',
                'color' => '#94a3b8',
                'order' => 1,
            ],
            [
                'name' => 'Qualified',
                'color' => '#3b82f6',
                'order' => 2,
            ],
            [
                'name' => 'Not Interested',
                'color' => '#ef4b4b',
                'order' => 3,
            ],
            [
                'name' => 'Negotiating',
                'color' => '#f7eb5a',
                'order' => 4,
            ],
            [
                'name' => 'Need more info',
                'color' => '#f7eb5a',
                'order' => 5,
            ],
            [
                'name' => 'Closed',
                'color' => '#3b82f6',
                'order' => 6,
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

        foreach (HeaderAttribute::DEFAULT_HEADERS as $HEADER) {
            if (in_array($HEADER['id'], [4, 10, 16, 9])) {
                TemplateHeader::create([
                    'template_id' => $template->id,
                    'header_id' => $HEADER['id'],
                ]);
            }
        }

        foreach (FieldAttribute::DEFAULT_FIELDS as $FIELD) {
            if (in_array($FIELD['id'], [4, 2, 5])) {
                TemplateField::create(
                    [
                        'template_id' => $template->id,
                        'field_id' => $FIELD['id'],
                    ]
                );
            }
        }


        // Template Number 3
        $template = Template::create([
            'name' => 'Fund raising',
            'icon' => '💲',
            'description' => 'Fund raising template',
        ]);

        $stages = [
            [
                'name' => 'Lead',
                'color' => '#6366F1',
                'order' => 0,
            ],
            [
                'name' => 'Contacted',
                'color' => '#22C55E',
                'order' => 1,
            ],
            [
                'name' => 'Pitched',
                'color' => '#3B82F6',
                'order' => 2,
            ],
            [
                'name' => 'Comitted',
                'color' => '#EC4899',
                'order' => 3,
            ],
            [
                'name' => 'Money In Bank',
                'color' => '#A855F7',
                'order' => 4,
            ],
            [
                'name' => 'Dead',
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

        $customFields = [
            [
                'name' => 'Type',
                'code' => 'fundraiser_type',
                'description' => 'Fund raiser type',
                'icon' => 'ListBulletIcon',
                'type' => 'select',
                'options' => [
                    'Angel',
                    'VC',
                    'Accelerator'
                ]
            ],
            [
                'name' => 'Meetings to Date',
                'code' => 'meetings_to_date',
                'description' => 'Meetings to Date',
                'icon' => 'HashtagIcon',
                'type' => 'number'
            ],
            [
                'name' => 'Value',
                'code' => 'fundraiser_value',
                'description' => 'Value',
                'icon' => 'CurrencyDollarIcon',
                'type' => 'currency'
            ]
        ];

        foreach ($customFields as $customField) {
            $field = CustomField::create(
                [
                    'user_id' => 1,
                    'team_id' => 1,
                    'name' => $customField['name'],
                    'code' => $customField['code'],
                    'description' => $customField['description'],
                    'type' => $customField['type'],
                ]
            );
            if (in_array($customField['type'],['select','multi_select']) && isset($customField['options'])) {
                foreach ($customField['options'] as $index => $option) {
                    CustomFieldOption::create(
                        [
                            'custom_field_id' => $field->id,
                            'value' => $option,
                            'order' => $index
                        ]
                    );
                }
            }
            TemplateHeader::create([
                'template_id' => $template->id,
                'header_id' => $field->id,
            ]);

            TemplateField::create(
                [
                    'template_id' => $template->id,
                    'field_id' => $field->id,
                ]
            );
        }
    }
}
