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
        $orderedIds = FieldAttribute::query()->unHidden()->where('user_id', Auth::id())->orderBy('order')->pluck('field_id')->toArray();
        $fields = $this->orderFields($fields, $orderedIds);
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
            $customField->visible = ! intval($customField->hide);
        }
        $defaultHeaders = FieldAttribute::DEFAULT_HEADERS;
        $fields = array_merge($customFields->toArray(), $defaultHeaders);
        $orderedFieldIds = FieldAttribute::query()->where('user_list_id', $listId)->unHidden()->orderBy('order')->pluck('field_id')->toArray();
        $headerFields = $this->orderFields($fields, $orderedFieldIds);
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

    public function setFieldAttributes(Request $request, $id)
    {
        if ($request->custom) {
            $field = CustomField::query()->where('id', $id)->first();
        } else {
            $defaultsFields = collect(FieldAttribute::DEFAULT_FIELDS);
            $field = (object) $defaultsFields->where('id', 5)->first();
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
            FieldAttribute::updateSortOrder($id, Auth::id(), $newIndex, $oldIndex, $request->listId);
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
}
