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
    public function headerFields($listId = null)
    {
        $customFields = CustomField::query()->with('customFieldOptions')->get();
        foreach ($customFields as &$customField) {
            $customField->custom = true;
            $customField->key = $customField->code;
        }
        $defaultHeaders = HeaderAttribute::DEFAULT_HEADERS;
        $headers = array_merge($customFields->toArray(), $defaultHeaders);
        $headerAttributes = HeaderAttribute::getHeaderAttributes(['user_list_id' => $listId]);
        $headerAttributesKeyed = $headerAttributes->keyBy('header_id');

        foreach ($headers as &$header) {
            $header['hide'] = $headerAttributesKeyed[$header['id']]['hide'] ?? 0;
            $header['width'] = intval($headerAttributesKeyed[$header['id']]['width'] ?? 160);
        }
        $headerFields = $this->orderFields($headers, $headerAttributes->pluck('header_id')->toArray());
        array_unshift($headerFields, HeaderAttribute::FULL_NAME_HEADER);
        return response()->json([
            'status' => true,
            'data' => $headerFields
        ], 200);
    }

    public function orderFields($headers, $orderedHeaderIds)
    {
        return collect($headers)->sortBy(function (&$item) use ($orderedHeaderIds) {
            return array_search($item['id'], $orderedHeaderIds);
        })->values()->toArray();
    }

    public function toggleHeaderHide(Request $request, $id)
    {
        if ($request->custom) {
            $header = CustomField::query()->where('id', $id)->first();
        } else {
            $defaultsFields = collect(HeaderAttribute::DEFAULT_HEADERS);
            $header = (object) $defaultsFields->where('id', $id)->first();
        }

        if (!$header) {
            throw ValidationException::withMessages([
                'header' => ['header does not exists']
            ]);
        }
        HeaderAttribute::toggleHeaderHide($header->id, $request->hide, $request->listId);
        return response()->json([
            'status' => true,
            'message' => 'Visibility Updated'
        ], 200);
    }

    public function setHeaderOrder(Request $request, $id)
    {
        if ($request->custom) {
            $header = CustomField::query()->where('id', $id)->first();
        } else {
            $defaultsFields = collect(HeaderAttribute::DEFAULT_HEADERS);
            $header = (object) $defaultsFields->where('id', $id)->first();
        }

        if (!$header) {
            throw ValidationException::withMessages([
                'header' => ['header does not exists']
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
            HeaderAttribute::updateSortOrder($newIndex, $oldIndex, $id, $request->listId);
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
            $header = CustomField::query()->where('id', $id)->first();
        } else {
            $defaultsFields = collect(HeaderAttribute::DEFAULT_HEADERS);
            $header = (object) $defaultsFields->where('id', $id)->first();
        }

        if (!$header) {
            throw ValidationException::withMessages([
                'field' => ['field does not exists']
            ]);
        }
        HeaderAttribute::updateFieldWidth($header->id, $request->width, $request->listId);
        return response()->json([
            'status' => true,
        ], 200);
    }
}
