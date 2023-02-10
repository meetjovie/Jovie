<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
