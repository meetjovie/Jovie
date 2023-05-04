<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use App\Traits\CustomFieldsTrait;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
        $fieldAttributes = FieldAttribute::getFieldsAttributes(['user_id' => Auth::id()]);
        $fieldAttributesKeyed = $fieldAttributes->keyBy('field_id');

        foreach ($fields as &$field) {
            $field['hide'] = $fieldAttributesKeyed[$field['id']]['hide'] ?? 0;
        }

        $fields = $this->orderFields($fields, $fieldAttributes->pluck('field_id')->toArray());
        return response()->json([
            'status' => true,
            'data' => $fields
        ], 200);
    }

    public function headerFields($listId)
    {
        $customFields = CustomField::query()->with('customFieldOptions')->get();
        foreach ($customFields as &$customField) {
            $customField->custom = true;
            $customField->key = $customField->code;
        }
        $defaultHeaders = FieldAttribute::DEFAULT_HEADERS;
        $fields = array_merge($customFields->toArray(), $defaultHeaders);
        $headerAttributes = FieldAttribute::getFieldsAttributes(['user_list_id' => $listId]);
        $headerAttributesKeyed = $headerAttributes->keyBy('field_id');

        foreach ($fields as &$field) {
            $field['hide'] = $headerAttributesKeyed[$field['id']]['hide'] ?? 0;
            $field['width'] = intval($headerAttributesKeyed[$field['id']]['width'] ?? 60);
        }
        $headerFields = $this->orderFields($fields, $headerAttributes->pluck('field_id')->toArray());
        array_unshift($headerFields, FieldAttribute::FULL_NAME_HEADER);
        return response()->json([
            'status' => true,
            'data' => $headerFields
        ], 200);
    }

    public function orderFields($fields, $orderedFieldIds)
    {
        return collect($fields)->sortBy(function (&$item) use ($orderedFieldIds) {
            return array_search($item['id'], $orderedFieldIds);
        })->values()->toArray();
    }

    public function setFieldOrder(Request $request, $id)
    {
        if ($request->custom) {
            $field = CustomField::query()->where('id', $id)->first();
        } elseif ($request->listId) {
            $defaultsFields = collect(FieldAttribute::DEFAULT_HEADERS);
            $field = (object) $defaultsFields->where('id', $id)->first();
        } else {
            $defaultsFields = collect(FieldAttribute::DEFAULT_FIELDS);
            $field = (object) $defaultsFields->where('id', $id)->first();
        }

        if (!$field) {
            throw ValidationException::withMessages([
                'field' => ['field does not exists']
            ]);
        }

        $request->validate([
            'newIndex' => 'required|integer',
            'oldIndex' => 'required|integer'
        ]);

        try {
            $newIndex = $request->newIndex;
            $oldIndex = $request->oldIndex;
            if ($newIndex == $oldIndex) {
                return response()->json([
                    'status' => true,
                    'message' => 'Order updated'
                ], 202);
            }
            FieldAttribute::updateSortOrder(Auth::id(), $newIndex, $oldIndex, $id, $request->listId);
            return response()->json([
                'status' => true,
                'message' => 'Order updated'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed. Try again later.',
                'error' => $e->getMessage()
            ], 200);
        }
    }

    public function toggleFieldHide(Request $request, $id)
    {
        if ($request->custom) {
            $field = CustomField::query()->where('id', $id)->first();
        } elseif ($request->listId) {
            $defaultsFields = collect(FieldAttribute::DEFAULT_HEADERS);
            $field = (object) $defaultsFields->where('id', $id)->first();
        } else {
            $defaultsFields = collect(FieldAttribute::DEFAULT_FIELDS);
            $field = (object) $defaultsFields->where('id', $id)->first();
        }

        if (!$field) {
            throw ValidationException::withMessages([
                'field' => ['field does not exists']
            ]);
        }
        FieldAttribute::toggleFieldHide(Auth::user(), $field->id, $request->hide, $request->listId);
        return response()->json([
            'status' => true,
            'message' => 'Visibility Updated'
        ], 200);
    }

    public function setFieldWidth(Request $request, $id)
    {
        if ($request->custom) {
            $field = CustomField::query()->where('id', $id)->first();
        } else {
            $defaultsFields = collect(FieldAttribute::DEFAULT_HEADERS);
            $field = (object) $defaultsFields->where('id', $id)->first();
        }

        if (!$field) {
            throw ValidationException::withMessages([
                'field' => ['field does not exists']
            ]);
        }
        FieldAttribute::updateFieldWidth(Auth::user(), $field->id, $request->width, $request->listId);
        return response()->json([
            'status' => true,
        ], 200);
    }
}
