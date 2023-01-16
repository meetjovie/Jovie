<?php

namespace App\Http\Controllers;

use App\Models\FieldAttribute;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    public function fields()
    {
        return response()->json([
            'status' => true,
            'data' => FieldAttribute::DEFAULT_FIELDS
        ], 200);
    }
}
