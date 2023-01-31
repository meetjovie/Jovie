<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use App\Traits\CustomFieldsTrait;
use Cassandra\Custom;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    use CustomFieldsTrait;

    public function fields($creatorId)
    {
        $customFields = CustomField::query()->with('customFieldOptions')->get();
        foreach ($customFields as &$customField) {
            $customField->custom = true;
            $customField->input_values = $this->getInputValues($customField, $creatorId);
        }
        $defaultFields = FieldAttribute::DEFAULT_FIELDS;
        $fields = array_merge($customFields->toArray(), $defaultFields);
        return response()->json([
            'status' => true,
            'data' => $fields
        ], 200);
    }
}
