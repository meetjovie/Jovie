<?php

namespace App\Traits;

use App\Models\Creator;
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
        if (! in_array($customField->type, ['select', 'multiselect'])) {
            return $customField->customFieldOptions->first()->value;
        }

        return null;
    }

    public function getInputAttributesForItems(CustomField $customField): array
    {
        switch ($customField->type) {
            case 'text':
                $attributes = [
                    'data-item' => $customField->code,
                    'v-model' => null,
                    ':value' => 'row.' . $customField->code . ' = this.' . $customField->code . '[index]',
                    '@input' => 'row.' . $customField->code . ' = $event.target.value; this.' . $customField->code . '[index] = $event.target.value; onBindingItemField(index, "' . $customField->code . '")',
                    'placeholder' => $this->getDefaultValue($customField),
                ];

                break;
            case 'textarea':
                $attributes = [
                    'data-item' => $field->code,
                    'v-model' => null,
                    ':value' => 'row.' . $field->code . ' = this.' . $field->code . '[index]',
                    '@input' => 'row.' . $field->code . ' = $event.target.value; this.' . $field->code . '[index] = $event.target.value; onBindingItemField(index, "' . $field->code . '")',
                    'placeholder' => $this->getDefaultValue($field),
                ];

                break;

            case 'date':
            case 'time':
            case 'dateTime':
                $attributes = [
                    'data-item' => $field->code,
                    'v-model' => 'row.' . $field->code,
                    'change' => 'onBindingItemField(index, "' . $field->code . '")',
                    'model' => 'this.' . $field->code . '[index]',
                    'show-date-format' => $this->getCompanyDateFormat(),
                ];

                break;

            case 'select':
                $attributes = [
                    'data-item' => $field->code,
                    'v-model' => 'row.' . $field->code,
                    'visible-change' => 'onBindingItemField(index, "' . $field->code . '")',
                    'model' => 'this.' . $field->code . '[index]',
                ];

                break;

            case 'checkbox':
                $attributes = [
                    ':id' => '"checkbox-' . $field->code . '-:item_id-" + index',
                    'data-item' => $field->code,
                    '@change' => 'onBindingItemField(index, "' . $field->code . '")',
                    'v-model' => 'row.' . $field->code,
                ];

                break;

            default:
                $attributes = [];

                break;
        }

        if (Str::contains('required', $field->rule)) {
            $attributes['required'] = 'required';
        }

        if ($field->type->type == 'textarea') {
            $attributes['rows'] = '3';
        }

        return $attributes;
    }

    public function getInputValues($field, $model, $class = Creator::class)
    {
        $value = null;

        if (is_null($model)) {
            return $value;
        }

        $value = $this->getDefaultValue($field);

        // getting recorded value of field
        $field_value = $field->customFieldValues()->for($model, $class)->first();

        if (!is_null($field_value) && !empty($field_value->value)) {
            $value = $field_value->value;
        }

        return $value;
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
