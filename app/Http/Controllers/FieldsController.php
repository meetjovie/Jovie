<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use App\Models\Template;
use App\Models\UserList;
use App\Traits\CustomFieldsTrait;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class FieldsController extends Controller
{
    use CustomFieldsTrait;

    public function fields(Request $request)
    {
        $creatorId = $request->input('creator_id');
        $listId = $request->input('list_id');

        // global custom fields
        $customFields = CustomField::query()->with(['customFieldOptions', 'userLists', 'templates'])->where(function ($query) {
            $query->whereDoesntHave('userLists')->whereDoesntHave('templates');
        });
        if ($listId) {
            $customFields = $customFields->orWhereHas('userLists', function ($query) use ($listId) {
                $query->where('user_list_id', $listId);
            });
        }
        $customFields = $customFields->get();

        foreach ($customFields as &$customField) {
            $customField->custom = true;
            $customField->input_values = $this->getInputValues($customField, $creatorId);
        }
        $defaultFields = FieldAttribute::DEFAULT_FIELDS;

        $UserList = UserList::find($listId);
        $template = $UserList ? $UserList->template : Template::where('name', Template::DEFAULT_TEMPLATE_NAME)->first();
        $userListTemplateFields = $template->templateFields->pluck('field_id')->toArray();

        $headers = array_values(array_filter($defaultFields, function ($value) use ($userListTemplateFields) {
            return in_array($value['id'], $userListTemplateFields);
        }));

        $fields = array_merge($customFields->toArray(), $headers);
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
        } else {
            $defaultsFields = collect(FieldAttribute::DEFAULT_FIELDS);
            $field = (object)$defaultsFields->where('id', $id)->first();
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
            FieldAttribute::updateSortOrder(Auth::id(), $newIndex, $oldIndex, $id);
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
