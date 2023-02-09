<?php

namespace App\Traits;

use App\Models\Crm;
use App\Models\CustomField;
use Illuminate\Support\Str;

trait CustomFieldsTrait
{
    public function getFieldsByTeam($teamId)
    {
        return CustomField::query()->where('team_id', $teamId)->with('customFieldOptions')->get();
    }

    public function getDefaultValue(CustomField $customField)
    {
        if (in_array($customField->type, ['multi_select'])) {
            return [];
        }
        elseif (in_array($customField->type, ['checkbox'])) {
            return false;
        }

        return null;
    }

    // to model
    public function getInputValues($field, $model, $class = Crm::class)
    {
        $value = null;

        if (is_null($model)) {
            return $value;
        }

        $value = $this->getDefaultValue($field);

        // getting recorded value of field
        $fieldValue = $field->customFieldValues()->for($model, $class)->first();
        if (!is_null($fieldValue) && !empty($fieldValue->value)) {
            $value = $fieldValue->value;
            if ($field->type == 'checkbox') {
                $value = !!$value;
            }
        }

        return $value;
    }

    // to print
    public function getFieldValue($field, $model, $class = Crm::class)
    {
        $fieldValue = $field->customFieldValues()->for($model->id, $class)->first();

        if (!is_null($fieldValue) && !is_null($fieldValue->value)) {
            $value = $fieldValue->value;

            if (in_array($field->type, ['multi_select'])) {
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

//            if ($fieldValue->type == 'radio' && $value == 0) {
//                $value = trans('general.no');
//            }
//
//            if ($fieldValue->type == 'radio' && $value == 1) {
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
