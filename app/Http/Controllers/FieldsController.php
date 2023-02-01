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
        return response()->json([
            'status' => true,
            'data' => $fields
        ], 200);
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
            FieldAttribute::updateSortOrder($id, Auth::id(), $newIndex, $oldIndex);
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
