<?php

namespace App\Http\Controllers;

use App\Models\UserList;
use Illuminate\Support\Facades\DB;
use function collect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserListsController extends Controller
{
    public function getLists(Request $request)
    {
        $lists = UserList::getLists(Auth::id());
        return collect([
            'status' => true,
            'lists' => $lists,
        ]);
    }

    public function sortLists(Request $request, $id)
    {
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
            UserList::updateSortOrder($id, Auth::id(), $newIndex, $oldIndex);
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
