<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\FieldAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'name' => ['required', 'unique:custom_fields,name,NULL,id,team_id,' . Auth::user()->currentTeam->id],
            'type' => ['required', 'in:' . implode(',', array_map(function ($type) {
                    return $type['id'];
                }, CustomField::CUSTOM_FIELD_TYPES))]
        ]);
        $data['code'] = null; // works with mutators
        $data['user_id'] = Auth::id();
        $data['team_id'] = Auth::user()->currentTeam->id;
        $customField = CustomField::query()->create($data);
        return response()->json([
            'status' => true,
            'message' => 'Field added',
            'data' => $customField
        ]);
    }
}
