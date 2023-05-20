<?php

namespace App\Services;

use App\Models\FieldAttribute;
use App\Models\HeaderAttribute;

class AttributesService
{
    public static function setAttributes($user, $team, $reset = 0)
    {
        if ($reset) {
            FieldAttribute::query()->delete();
            HeaderAttribute::query()->delete();
        }
        $customFields = $team->customFields;
        $defaultFieldIds = array_column(FieldAttribute::DEFAULT_FIELDS, 'id');

        $fieldIds = array_merge($defaultFieldIds, $customFields->pluck('id')->toArray());

        foreach ($fieldIds as $k => $fieldId) {
            $data = [
                'type' => is_numeric($fieldId) ? 'default' : 'custom',
            ];
            if (! $reset) {
                $data['order'] = $k;
            }
            FieldAttribute::query()->updateOrCreate([
                'field_id' => $fieldId,
                'user_id' => $user->id,
                'team_id' => $team->id,
            ], $data);
        }

        if ($team->owner_id == $user->id) {
            $defaultHeaders = HeaderAttribute::DEFAULT_HEADERS;
            $fieldHeaders = array_merge($defaultHeaders, $customFields->toArray());
            foreach ($fieldHeaders as $k => $fieldHeader) {
                $data = [
                    'user_id' => $user->id,
                    'team_id' => $team->id,
                    'type' => is_numeric($fieldHeader['id']) ? 'default' : 'custom',
                    'hide' => array_key_exists('hide', $fieldHeader) ? $fieldHeader['hide'] : false
                ];
                if (! $reset) {
                    $data['order'] = $k;
                }
                HeaderAttribute::query()->updateOrCreate([
                    'header_id' => $fieldHeader['id'],
                    'team_id' => $team->id,
                ], [
                    'user_id' => $user->id,
                    'team_id' => $team->id,
                    'type' => is_numeric($fieldHeader['id']) ? 'default' : 'custom',
                    'order' => $k,
                    'hide' => array_key_exists('hide', $fieldHeader) ? $fieldHeader['hide'] : false
                ]);
            }
            foreach ($team->userLists as $list) {
                foreach ($fieldHeaders as $k => $fieldHeader) {
                    $data = [
                        'user_id' => $user->id,
                        'team_id' => $team->id,
                        'type' => is_numeric($fieldHeader['id']) ? 'default' : 'custom',
                        'hide' => array_key_exists('hide', $fieldHeader) ? $fieldHeader['hide'] : false
                    ];
                    if (! $reset) {
                        $data['order'] = $k;
                    }
                    HeaderAttribute::query()->updateOrCreate([
                        'header_id' => $fieldHeader['id'],
                        'user_list_id' => $list->id,
                        'team_id' => $team->id,
                    ], [
                        'user_id' => $user->id,
                        'team_id' => $team->id,
                        'type' => is_numeric($fieldHeader['id']) ? 'default' : 'custom',
                        'order' => $k,
                        'hide' => array_key_exists('hide', $fieldHeader) ? $fieldHeader['hide'] : false
                    ]);
                }
            }
        }
    }
}
