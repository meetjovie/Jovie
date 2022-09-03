<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserList;
use App\Models\UserListAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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
        $list = UserList::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$list) {
            throw ValidationException::withMessages([
                'list' => ['List does not exists']
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

    public function pinList($id)
    {
        $list = UserList::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$list) {
            throw ValidationException::withMessages([
                'list' => ['List does not exists']
            ]);
        }

        $user = User::currentLoggedInUser();
        $pinnedCount = UserListAttribute::where('user_id', $user->id)->where('team_id', $user->currentTeam->id)->where('pinned', 1)->count();
        if ($pinnedCount >= 5) {
            return response()->json([
                'status' => false,
                'message' => 'You can not pin more than 5 lists.'
            ], 200);
        }

        UserListAttribute::where('user_id', $user->id)->where('user_list_id', $id)->update(['pinned' => 1]);
        return response()->json([
            'status' => true,
            'message' => 'List pinned.'
        ], 200);
    }

    public function unpinList($id)
    {
        $list = UserList::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$list) {
            throw ValidationException::withMessages([
                'list' => ['List does not exists']
            ]);
        }

        UserListAttribute::where('user_id', Auth::id())->where('user_list_id', $id)->update(['pinned' => 0]);
        return response()->json([
            'status' => true,
            'message' => 'List unpinned.'
        ], 200);
    }

    public function duplicateList($id)
    {
        $list = UserList::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$list) {
            throw ValidationException::withMessages([
                'list' => ['List does not exists']
            ]);
        }
        $newList = $list->duplicateList(Auth::id());
        return response()->json([
            'status' => true,
            'message' => 'List duplicated.',
            'list' => $newList
        ], 200);
    }

    public function deleteList($id)
    {
        $list = UserList::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$list) {
            throw ValidationException::withMessages([
                'list' => ['List does not exists']
            ]);
        }
        $deleted = $list->delete();
        if ($deleted) {
            UserList::updateSortOrder(null, Auth::id());
            return response()->json([
                'status' => true,
                'message' => 'List deleted.'
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Try again.'
        ], 200);
    }

    public function createList(Request $request)
    {
        $list = UserList::firstOrCreateList(Auth::id(), 'New List');
        return response()->json([
            'status' => true,
            'message' => 'List Created.',
            'list' => $list
        ], 200);
    }

    public function updateList(Request $request, $id)
    {
        $list = UserList::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$list) {
            throw ValidationException::withMessages([
                'list' => ['List does not exists']
            ]);
        }
        $data = $request->validate([
            'name' => 'sometimes|string|unique:user_lists,name,'.$list->id.',id,team_id,'.$list->team_id,
            'emoji' => 'sometimes|string'
        ]);
        $list->update($data);
        UserList::updateSortOrder(null, Auth::id());
        return response()->json([
            'status' => true,
            'message' => 'List updated.'
        ], 200);
    }
}
