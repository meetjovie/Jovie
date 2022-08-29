<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'emoji'
    ];

    public function creators()
    {
        return $this->belongsToMany(Creator::class)->withTimestamps();
    }

    public static function firstOrCreateList($userId, $listName)
    {
        $user = User::with('currentTeam.users')->where('user_id', $userId)->first();
        if ($user) {
            $teamUsers = $user->currentTeam->users->pluck('id')->toArray();
            $exists = UserList::whereRaw('TRIM(LOWER(name)) = ?', [strtolower(trim($listName))])->whereIn('user_id', $teamUsers)->first();
            if ($exists) {
                return $exists;
            }
            $list = UserList::create([
                'user_id' => $userId,
                'name' => $listName,
            ]);
            $list->orderUserList()->sync([$userId => ['order' => 0]]);
            self::updateSortOrder($list->id, $userId);
            return  $list;
        }
        return new UserList();
    }

    public static function updateSortOrder($listId, $userId, $newIndex = 0, $oldIndex = -1)
    {
        $currentTeamLists = UserList::getLists($userId);
        $currentTeamLists = $currentTeamLists->pluck('id')->toArray();
        DB::beginTransaction();
        if ($newIndex > $oldIndex) {
            // update user list set order = order-1 where order <= newIndex and id != listID
            DB::table('order_user_list')
                ->where('order', '<=', $newIndex)
                ->where(function ($q) use ($listId, $currentTeamLists){
                    $q->where('user_list_id', '!=', $listId)->whereIn('user_list_id', $currentTeamLists);
                })
                ->where('user_id', $userId)
                ->update(['order' => (DB::raw('`order` - 1'))]);
            // update userlist set order = newOrder where id = listId
            DB::table('order_user_list')
                ->where('user_list_id', $listId)
                ->where('user_id', $userId)
                ->update(['order' => $newIndex]);
        } else { // newIndex < $oldIndex
            // update user list set order = order+1 where order >= newIndex and id != listID
            DB::table('order_user_list')
                ->where('order', '>=', $newIndex)
                ->where(function ($q) use ($listId, $currentTeamLists){
                    $q->where('user_list_id', '!=', $listId)->whereIn('user_list_id', $currentTeamLists);
                })
                ->where('user_id', $userId)
                ->update(['order' => (DB::raw('`order` + 1'))]);
            // update userlist set order = newOrder where id = listId
            DB::table('order_user_list')
                ->where('user_list_id', $listId)
                ->where('user_id', $userId)
                ->update(['order' => $newIndex]);
        }
        $listOrders = DB::table('order_user_list')->where('user_id', $userId)->where('user_list_id', $listId)->orderBy('order')->get();
        foreach ($listOrders as $k => $list) {
            DB::table('order_user_list')
                ->where('user_list_id', $list->id)
                ->where('user_id', $list->user_id)
                ->update(['order' => $k]);
        }
        DB::commit();
        return true;
    }

    public static function getLists($userId)
    {
        $user = User::with('currentTeam')->where('id', $userId)->first();
        $teamUsers = $user->currentTeam->users->pluck('id')->toArray();
        return UserList::orderBy(
            DB::table('order_user_list')
            ->join('user_lists', 'user_lists.id', 'order_user_list.user_list_id')
            ->whereIn('user_lists.user_id', $teamUsers)->select('order')->orderBy('order')->limit(1)
        )->whereIn('user_id', $teamUsers)->get();
    }

    public function orderUserList()
    {
        return $this->belongsToMany(User::class, 'order_user_list')->withTimestamps();
    }
}
