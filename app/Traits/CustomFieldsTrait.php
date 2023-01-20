<?php

namespace App\Traits;

use App\Models\CustomField;

trait CustomFieldsTrait
{
    public function getFieldsByTeam($teamId)
    {
        return CustomField::query()->where('team_id', $teamId)->with('customFieldOptions')->get();
    }

    public function getFieldValue($field, $model)
    {
        $modelClass = get_class($model);
        $fieldValue = $field->customFieldValues()->for($model->id, $modelClass)->first();

        if (!is_null($fieldValue) && !is_null($fieldValue->value)) {
            $value = $fieldValue->value;

            if (in_array($field->type, ['checkbox', 'multi_select'])) {
                $fieldOptions = $field->customFieldOptions->pluck('value', 'id');
            }

            if (!is_array($fieldValue->value) && isset($fieldOptions[$fieldValue->value])) {
                $value = $fieldOptions[$fieldValue->value];
            }

            if (is_array($fieldValue->value)) {
                $value = null;

                foreach ($fieldValue->value as $item) {
                    if (!isset($fieldOptions[$item])) {
                        continue;
                    }

                    $value .= "{$fieldOptions[$item]}, ";
                }

                if ($value != null) {
                    $value = rtrim($value, ", ");
                }
            }

//            if ($field_value->type == 'radio' && $value == 0) {
//                $value = trans('general.no');
//            }
//
//            if ($field_value->type == 'radio' && $value == 1) {
//                $value = trans('general.yes');
//            }
        }

        // if no date set dont show current date

//        if ($field->type->type == 'date') {
//            $value = company_date($value);
//        }
//
//        if ($field->type->type == 'dateTime') {
//            $value = Date::parse($value)->format(company_date_format() . ' H:i');
//        }

        return $value;
    }
}
