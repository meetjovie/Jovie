<?php

namespace App\Models;

use App\Events\Notification;
use App\Events\UserListDuplicated;
use App\Jobs\DuplicateList;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'emoji',
        'team_id'
    ];

    protected $appends = ['updating_list'];

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
                self::updateSortOrder($list->id, $userId, 0, 1);
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
        return UserList::query()
            ->withCount('creators')
            ->join('user_list_attributes as ula', function ($join) use ($user) {
                $join->on('ula.user_list_id', '=', 'user_lists.id')
                    ->where('ula.user_id', $user->id)
                    ->where('ula.team_id', $user->currentTeam->id);
            })
            ->where('user_lists.team_id', $user->currentTeam->id)
            ->addSelect('user_lists.*', 'ula.order', 'ula.pinned')
            ->orderBy('order')->get();
    }

    public static function getListsByTeam($teamId)
    {
        return UserList::query()->where('team_id', $teamId)->get();
    }

    public function userListAttributes()
    {
        return $this->belongsToMany(User::class, 'user_list_attributes')->withTimestamps();
    }

    public function duplicateList()
    {
        $newListName = ($this->name.' - copy');
        $newList = self::firstOrCreateList($this->user_id, $newListName);
        $totalCreatorsCount = DB::table('creator_user_list')->where('user_list_id', $this->id)->count();

        if ($totalCreatorsCount) {
            $jobs = [];
            for ($i=0; $i<$totalCreatorsCount; $i+=50) {
                $jobs[] = (new DuplicateList($i, 50, $newList->id, $this->id));
            }
            $batch = Bus::batch($jobs)->then(function (Batch $batch) use ($newList) {
                Log::info('All jobs completed successfully...');
                UserListDuplicated::dispatch($newList, $this->user_id, $this->team_id, true, ('Your list '.$newList->name.' is duplicated successfully'));
            })->catch(function (Batch $batch, Throwable $e = null) use ($newList) {
                Log::info('First batch duplicating job failure detected...');
                Log::channel('slack_warning')->info('User list duplicate fail', ['batch' => $batch->id]);
                UserListDuplicated::dispatch($newList, $this->user_id, $this->team_id, false, ('Your list '.$newList->name.' failed to duplicate. Support has been notified automatically'));
            })->finally(function (Batch $batch) {
                Log::info('The batch duplication has finished executing...');
            })->dispatch();
            DB::table('job_batches')->where('id', $batch->id)->update([
                'name' => $newListName,
                'user_list_id' => $newList->id,
                'initial_total_in_file' => $totalCreatorsCount,
                'type' => 'duplicating',
            ]);
            Notification::dispatch($this->team_id);
        } else {
            UserListDuplicated::dispatch($newList, $this->user_id, $this->team_id, true, ('Your list '.$newList->name.' is duplicated successfully'));
        }

        return $newList;
    }

    /**
     * Interact the updating
     *
     * @return Attribute
     */
    protected function updatingList(): Attribute
    {
        return Attribute::make(
            get: fn () => (JobBatch::where('type', 'duplicating')->where('finished_at', null)->where('cancelled_at', null)->where('user_list_id', $this->id)->count() ||
                Import::orderByDesc('created_at')
                    ->where('user_list_id', $this->id)
                    ->where('dispatched', '!=', 1)
                    ->orWhere(function ($q) {
                        $q->where('instagram_scrapped', '!=', 1)->orWhere('twitch_scrapped', '!=', 1);
                    })->count())
        );
    }
}
