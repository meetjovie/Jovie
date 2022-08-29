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
        $user = User::with('currentTeam.users')->where('id', $userId)->first();
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
            ]);
            $syncData = [];
            array_map(function ($value) use (&$syncData) {
                return $syncData[$value] = ['order' => 0];
            }, $teamUsers);
            $list->userListAttributes()->sync($syncData);
            foreach ($teamUsers as $userId) {
                self::updateSortOrder($list->id, $userId);
            }
            return  $list;
        }
        return new UserList();
    }

    public static function updateSortOrder($listId, $userId, $newIndex = 0, $oldIndex = 0)
    {
        $user = User::with('currentTeam')->where('id', $userId)->first();
        DB::beginTransaction();
        if ($newIndex > $oldIndex) {
            // update user list set order = order-1 where order <= newIndex and id != listID
            UserListAttribute::where('order', '<=', $newIndex)
                ->where('user_list_id', '!=', $listId)
                ->where('user_id', $userId)
                ->where('team_id', $user->currentTeam->id)
                ->update(['order' => (DB::raw('`order` - 1'))]);
            // update userlist set order = newOrder where id = listId
            UserListAttribute::where('user_list_id', $listId)
                ->where('user_id', $userId)
                ->update(['order' => $newIndex]);
        } else { // newIndex < $oldIndex
            // update user list set order = order+1 where order >= newIndex and id != listID
            UserListAttribute::where('order', '>=', $newIndex)
                ->where('user_list_id', '!=', $listId)
                ->where('user_id', $userId)
                ->where('team_id', $user->currentTeam->id)
                ->update(['order' => (DB::raw('`order` + 1'))]);
            // update userlist set order = newOrder where id = listId
            UserListAttribute::where('user_list_id', $listId)
                ->where('user_id', $userId)
                ->update(['order' => $newIndex]);
        }
        $listOrders = UserListAttribute::where('user_id', $userId)->where('team_id', $user->currentTeam->id)->orderBy('order')->get();
        foreach ($listOrders as $k => $list) {
            $listOrders->order = $k;
            $listOrders->save();
        }
        DB::commit();
        return true;
    }

    public static function getLists($userId)
    {
        $user = User::with('currentTeam')->where('id', $userId)->first();
        return UserList::query()->where('team_id', $user->currentTeam->id)->get();
    }

    public function userListAttributes()
    {
        return $this->belongsToMany(User::class, 'user_list_attributes')->withTimestamps();
    }
}
