<?php

namespace App\Models;

use App\Events\ListEnriched;
use App\Events\Notification;
use App\Events\UserListDuplicated;
use App\Jobs\DuplicateList;
use App\Models\Scopes\TeamScope;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Contracts\Auditable;
use Throwable;

class UserList extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'user_id',
        'emoji',
        'team_id',
        'updating',
    ];

    protected $appends = ['updating_list'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TeamScope());
    }

    public function getEmojiAttribute($value)
    {
        return $value ?? '📄';
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class)->withTimestamps();
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class)->withTimestamps();
    }

    public static function firstOrCreateList($userId, $listName, $teamId = null, $emoji = null, $updating = false)
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
                $exists->updating = $updating;
                $exists->save();
                foreach ($teamUsers as $userId) {
                    self::updateSortOrder($userId, 0, 1, $exists->id);
                }
                return $exists;
            }
            $data = [
                'user_id' => $userId,
                'name' => $listName,
                'team_id' => $user->currentTeam->id
            ];
            if ($emoji) {
                $data['emoji'] = $emoji;
                $data['updating'] = $updating;
            }
            $list = UserList::create($data);
            $syncData = [];
            array_map(function ($value) use (&$syncData, $user) {
                return $syncData[$value] = ['order' => 0, 'team_id' => $user->currentTeam->id];
            }, $teamUsers);
            $list->userListAttributes()->sync($syncData);
            foreach ($teamUsers as $userId) {
                self::updateSortOrder($userId, 0, 1, $list->id);
            }
            $customFieldIds = CustomField::query()->get()->toArray();
            $defaultIds = HeaderAttribute::DEFAULT_HEADERS;
            $headers = array_merge($customFieldIds, $defaultIds);
            foreach ($headers as $k => $header) {
                HeaderAttribute::create([
                    'header_id' => $header['id'],
                    'type' => (is_numeric($header) ? 'default' : 'custom'),
                    'order' => $k,
                    'team_id' => $user->currentTeam->id,
                    'user_id' => $user->id,
                    'user_list_id' => $list->id,
                    'hide' => $header['hide'] ?? false
                ]);
            }
            return $list;
        }
        return new UserList();
    }

    public static function updateSortOrder($userId, $newIndex = 0, $oldIndex = 0, $listId = null)
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
            ->withCount(['contacts' => function ($query) {
                $query->where('archived', false);
            }])
            ->join('user_list_attributes as ula', function ($join) use ($user) {
                $join->on('ula.user_list_id', '=', 'user_lists.id')
                    ->where('ula.user_id', $user->id)
                    ->where('ula.team_id', $user->currentTeam->id);
            })
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
        $newListName = ($this->name . ' - copy');
        $newList = self::firstOrCreateList($this->user_id, $newListName);
        $totalCreatorsCount = DB::table('creator_user_list')->where('user_list_id', $this->id)->count();

        if ($totalCreatorsCount) {
            $jobs = [];
            for ($i = 0; $i < $totalCreatorsCount; $i += 50) {
                $jobs[] = (new DuplicateList($i, 50, $newList->id, $this->id));
            }
            $batch = Bus::batch($jobs)->then(function (Batch $batch) use ($newList) {
                Log::info('All jobs completed successfully...');
                UserListDuplicated::dispatch($newList, $this->user_id, $this->team_id, true, ('Your list ' . $newList->name . ' is duplicated successfully'));
            })->catch(function (Batch $batch, Throwable $e = null) use ($newList) {
                Log::info('First batch duplicating job failure detected...');
                Log::channel('slack_warning')->info('User list duplicate fail', ['batch' => $batch->id]);
                UserListDuplicated::dispatch($newList, $this->user_id, $this->team_id, false, ('Your list ' . $newList->name . ' failed to duplicate. Support has been notified automatically'));
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
            UserListDuplicated::dispatch($newList, $this->user_id, $this->team_id, true, ('Your list ' . $newList->name . ' is duplicated successfully'));
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
            get: fn() => (JobBatch::where('type', 'duplicating')->where('finished_at', null)->where('cancelled_at', null)->where('user_list_id', $this->id)->count() ||
                Import::orderByDesc('created_at')
                    ->where('user_list_id', $this->id)
                    ->where(function ($q) {
                        $q->where(function ($qq) {
                            $qq->where('instagram_dispatched', '!=', 1)
                                ->orWhere(function ($qqq) {
                                    $qqq->where('instagram', '!=', null)->where('instagram_scrapped', '!=', 1);
                                });
                        })->orWhere(function ($qq) {
                            $qq->where('twitch_dispatched', '!=', 1)
                                ->orWhere(function ($qqq) {
                                    $qqq->where(function ($qqqq) {
                                        $qqqq->where('twitch', '!=', null)->orWhere('twitch_id', '!=', null);
                                    })->where('twitch_scrapped', '!=', 1);
                                });
                        });
                    })->count())
        );
    }

    public static function dispatchEnrichNotificationIfCompleted($listId, $teamId)
    {
        $countEnriching = Contact::query()->whereHas('userLists', function ($query) use ($listId) {
            $query->where('user_lists.id', $listId);
        })->where('enriching', 1)->count();

        if (!$countEnriching) {
            ListEnriched::dispatch($listId, $teamId);
        }
    }
}
