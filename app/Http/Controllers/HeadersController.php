<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use App\Models\HeaderAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class HeadersController extends Controller
{
    public function headerFields($listId)
    {
        $customFields = CustomField::query()->with('customFieldOptions')->get();
        foreach ($customFields as &$customField) {
            $customField->custom = true;
            $customField->key = $customField->code;
        }
        $defaultHeaders = HeaderAttribute::DEFAULT_HEADERS;
        $fields = array_merge($customFields->toArray(), $defaultHeaders);
        $headerAttributes = HeaderAttribute::getHeaderAttributes(['user_list_id' => $listId]);
        $headerAttributesKeyed = $headerAttributes->keyBy('field_id');

        foreach ($fields as &$field) {
            $field['hide'] = $headerAttributesKeyed[$field['id']]['hide'] ?? 0;
            $field['width'] = intval($headerAttributesKeyed[$field['id']]['width'] ?? 60);
        }
        $headerFields = $this->orderFields($fields, $headerAttributes->pluck('field_id')->toArray());
        array_unshift($headerFields, HeaderAttribute::FULL_NAME_HEADER);
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

    public function toggleHeaderHide(Request $request, $id)
    {
        if ($request->custom) {
            $field = CustomField::query()->where('id', $id)->first();
        } elseif ($request->listId) {
            $defaultsFields = collect(HeaderAttribute::DEFAULT_HEADERS);
            $field = (object) $defaultsFields->where('id', $id)->first();
        }

        if (!$field) {
            throw ValidationException::withMessages([
                'field' => ['field does not exists']
            ]);
        }
        HeaderAttribute::toggleHeaderHide(Auth::user(), $field->id, $request->hide, $request->listId);
        return response()->json([
            'status' => true,
            'message' => 'Visibility Updated'
        ], 200);
    }

    public function setHeaderOrder(Request $request, $id)
    {
        if ($request->custom) {
            $field = CustomField::query()->where('id', $id)->first();
        } else {
            $defaultsFields = collect(HeaderAttribute::DEFAULT_HEADERS);
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
            HeaderAttribute::updateSortOrder(Auth::id(), $newIndex, $oldIndex, $id, $request->listId);
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

    public function setHeaderWidth(Request $request, $id)
    {
        if ($request->custom) {
            $field = CustomField::query()->where('id', $id)->first();
        } else {
            $defaultsFields = collect(HeaderAttribute::DEFAULT_HEADERS);
            $field = (object) $defaultsFields->where('id', $id)->first();
        }

        if (!$field) {
            throw ValidationException::withMessages([
                'field' => ['field does not exists']
            ]);
        }
        HeaderAttribute::updateFieldWidth(Auth::user(), $field->id, $request->width, $request->listId);
        return response()->json([
            'status' => true,
        ], 200);
    }
}
