<?php

namespace App\Traits;

use App\Models\Contact;
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
    public function getInputValues($field, $model, $class = Contact::class)
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

    public function getFieldValueByModel($field, $model, $class = Contact::class)
    {
        $value = null;

        if (is_null($model)) {
            return $value;
        }

        $value = $this->getDefaultValue($field);

        $fieldValue = $field->customFieldvalues()->for($model->id, $class)->first();

        if (!is_null($fieldValue)) {
            $value = $fieldValue->value;

            $fieldOptions = [];
            if (in_array($field->type, ['multi_select', 'select'])) {
                $fieldOptions = $field->customFieldOptions->pluck('value', 'id')->toArray();
            }

            // if id is int but is enclosed in string parse it to int unless its uuid
            $fValue = is_numeric($fieldValue->value) ? $fieldValue->value : (ctype_digit($fieldValue->value) ? intval($fieldValue->value) : $fieldValue->value);

            if (!is_array($fieldValue->value) && isset($fieldOptions[$fValue])) {
                $value = $fieldOptions[$fValue];
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

            if ($field->type == 'checkbox' && $fieldValue->value == 0) {
                $value = 'No';
            }

            if ($field->type == 'checkbox' && $fieldValue->value == 1) {
                $value = 'Yes';
            }
        }

        return $value;
    }

}
