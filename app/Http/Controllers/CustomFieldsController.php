<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Clue\StreamFilter\fun;

class CustomFieldsController extends Controller
{
    public function customFieldTypes()
    {
        return response()->json([
            'status' => true,
            'data' => CustomField::CUSTOM_FIELD_TYPES
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255', 'unique:custom_fields,name,NULL,id,team_id,' . Auth::user()->currentTeam->id],
            'description' => ['sometimes'],
            'type' => ['required', 'in:' . implode(',', array_map(function ($type) {
                    return $type['id'];
                }, CustomField::CUSTOM_FIELD_TYPES))],
            'options' => ['required_if:type,select,multi_select', 'array']
        ]);
        $data['code'] = null; // works with mutators
        $data['user_id'] = Auth::id();
        $data['team_id'] = Auth::user()->currentTeam->id;
        $data['icon'] = collect(CustomField::CUSTOM_FIELD_TYPES)->where('id', $request->type)->first()['icon'];
        $customField = null;
        DB::transaction(function () use ($data, &$customField) {
            $customField = CustomField::query()->create($data);
            if (!empty($data['options'])) {
                $customField->customFieldOptions()->createMany($data['options']);
            }
            $teamUsers = Auth::user()->currentTeam->users->pluck('id')->toArray();
            foreach ($teamUsers as $userId) {
                FieldAttribute::create(['field_id' => $customField->id, 'type' => 'custom', 'order' => 0, 'team_id' => Auth::user()->currentTeam->id, 'user_id' => $userId]);
            }
            $userLists = Auth::user()->currentTeam->userLists->pluck('id')->toArray();
            foreach ($userLists as $userListId) {
                FieldAttribute::create(['field_id' => $customField->id, 'type' => 'custom', 'order' => 0, 'team_id' => Auth::user()->currentTeam->id, 'user_id' => $userId, 'user_list_id' => $userListId]);
            }
            foreach ($teamUsers as $userId) {
                FieldAttribute::updateSortOrder($userId, 0, 1, $customField->id);
            }
        });

        return response()->json([
            'status' => true,
            'message' => 'Field added',
            'data' => $customField
        ]);
    }

    public function update(Request $request, $id)
    {
        $customField = CustomField::query()->where('id', $id)->first();
        if (! $customField) {
            return response()->json([
                'status' => true,
                'message' => 'This field does not exist for you.',
            ]);
        }

        $data = $request->validate([
            'name' => ['required', 'max:255', "unique:custom_fields,name,$id,id,team_id," . Auth::user()->currentTeam->id],
            'description' => ['sometimes'],
            'type' => ['required', 'in:' . implode(',', array_map(function ($type) {
                    return $type['id'];
                }, CustomField::CUSTOM_FIELD_TYPES))],
            'options' => ['required_if:type,select,multi_select', 'array']
        ]);
        $customField = null;
        DB::transaction(function () use ($data, &$customField, $id) {
            $options = $data['options'];
            unset($data['options']);
            $customField->update($data);

            $oldOptions = $customField->customFieldOptions()->get();

            if (! count($oldOptions)) {
                $customField->customFieldValues()->delete();
                $values = collect($options)->pluck('value')->toArray();
            } else {
                $values = collect($options)->pluck('value', 'id')->toArray();
                foreach ($oldOptions as $oldOption) {
                    if (!in_array($oldOption->value, $values)) {
                        foreach ($customField->customFieldValues as $customFieldValue) {
                            if ($customFieldValue->value == $oldOption->id) {
                                $customFieldValue->delete();
                            }
                        }
                        $oldOption->delete();
                    }
                }
            }
            $index = 0;
            foreach ($values as $optionId => $value) {
                if (!in_array($value, $oldOptions->pluck('value')->toArray())) {
                    $customField->customFieldOptions()->create([
                        'value' => $value,
                        'order' => $index,
                    ]);
                } else {
                    $customField->customFieldOptions()->where('id', $optionId)->update([
                        'order' => $index
                    ]);
                }
                $index++;
            }
        });

        return response()->json([
            'status' => true,
            'message' => 'Field updated',
            'data' => $customField
        ]);
    }

    public function delete($id)
    {
        $customField = CustomField::query()->where('id', $id)->first();
        if (! $customField) {
            return response()->json([
                'status' => true,
                'message' => 'This field does not exist for you.',
            ]);
        }

        DB::transaction(function () use ($customField) {
            $customField->customFieldValues()->delete();
            $customField->customFieldOptions()->delete();
            $customField->fieldAttributes()->delete();
            $customField->delete();

            $teamUsers = Auth::user()->currentTeam->users->pluck('id')->toArray();
            foreach ($teamUsers as $userId) {
                FieldAttribute::updateSortOrder($userId, 0, 1, $customField->id);
            }
        });

        return response()->json([
            'status' => true,
            'message' => 'Field Deleted.',
            'data' => $customField
        ]);
    }
}
