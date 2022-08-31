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
        'emoji',
        'team_id'
    ];

    public function creators()
    {
        return $this->belongsToMany(Creator::class)->withTimestamps();
    }

    public static function firstOrCreateList($userId, $listName, $teamId = null)
    {
        $team = null;
        if ($teamId) {
            $team = Team::with('users')->where('id', $teamId)->first();
        }
        if ($teamId) {
            $user = User::where('id', $userId)->first();
            $user->currentTeam = $team;
        } else {
            $user = User::with('currentTeam.users')->where('id', $userId)->first();
        }
        if ($user) {
            $teamUsers = $user->currentTeam->users->pluck('id')->toArray();
            $exists = UserList::whereRaw('TRIM(LOWER(name)) = ?', [strtolower(trim($listName))])->whereIn('user_id', $teamUsers)->first();
            if ($exists) {
                foreach ($teamUsers as $userId) {
                    self::updateSortOrder($exists->id, $userId);
                }
                return $exists;
            }
            $list = UserList::create([
                'user_id' => $userId,
                'name' => $listName,
                'team_id' => $user->currentTeam->id
            ]);
            $syncData = [];
            array_map(function ($value) use (&$syncData, $user) {
                return $syncData[$value] = ['order' => 0, 'team_id' => $user->currentTeam->id];
            }, $teamUsers);
            $list->userListAttributes()->sync($syncData);
            foreach ($teamUsers as $userId) {
                self::updateSortOrder($list->id, $userId);
            }
            return  $list;
        }
        return new UserList();
    }

    public static function updateSortOrder($listId = null, $userId, $newIndex = 0, $oldIndex = 0)
    {
        $user = User::with('currentTeam')->where('id', $userId)->first();
        $userListIds = UserList::where('team_id', $user->currentTeam->id)->pluck('id')->toArray();
        $userListIdsToUpdate = array_diff($userListIds, [$listId]);
        DB::beginTransaction();
        if (!is_null($listId)) {
            if ($newIndex > $oldIndex) {
                // update user list set order = order-1 where order <= newIndex and id != listID
                UserListAttribute::where('order', '<=', $newIndex)
                    ->whereIn('user_list_id', $userListIdsToUpdate)
                    ->where('user_id', $userId)
                    ->update(['order' => (DB::raw('`order` - 1'))]);
                // update userlist set order = newOrder where id = listId
                UserListAttribute::where('user_list_id', $listId)
                    ->where('user_id', $userId)
                    ->update(['order' => $newIndex]);
            } elseif ($newIndex < $oldIndex) { // newIndex < $oldIndex
                // update user list set order = order+1 where order >= newIndex and id != listID
                UserListAttribute::where('order', '>=', $newIndex)
                    ->whereIn('user_list_id', $userListIdsToUpdate)
                    ->where('user_id', $userId)
                    ->update(['order' => (DB::raw('`order` + 1'))]);
                // update userlist set order = newOrder where id = listId
                UserListAttribute::where('user_list_id', $listId)
                    ->where('user_id', $userId)
                    ->update(['order' => $newIndex]);
            }
        }
        $listOrders = UserListAttribute::where('user_id', $userId)->whereIn('user_list_id', $userListIds)->orderBy('order')->get();
        foreach ($listOrders as $k => $list) {
            $list->order = $k;
            $list->save();
        }
        DB::commit();
        return true;
    }

    public static function getLists($userId)
    {
        $user = User::with('currentTeam')->where('id', $userId)->first();
        return DB::table('user_lists as ul')
            ->join('user_list_attributes as ula', function ($join) use ($user) {
                $join->on('ula.user_list_id', '=', 'ul.id')
                    ->where('ula.user_id', $user->id)
                    ->where('ula.team_id', $user->currentTeam->id);
            })
            ->where('ul.team_id', $user->currentTeam->id)
            ->select('ul.*', 'ula.order', 'ula.pinned')->orderBy('order')->get();
    }

    public static function getListsByTeam($teamId)
    {
        return UserList::query()->where('team_id', $teamId)->get();
    }

    public function userListAttributes()
    {
        return $this->belongsToMany(User::class, 'user_list_attributes')->withTimestamps();
    }

    public function duplicateList($userId)
    {
        $newListName = ($this->name.' - copy');
        $newList = self::firstOrCreateList($userId, $newListName);
        $creatorIds = DB::table('creator_user_list')->where('user_list_id', $this->id)->pluck('creator_id')->toArray();
        $newList->creators()->sync($creatorIds);
    }
}
