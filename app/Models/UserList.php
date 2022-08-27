<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            return  $list;
        }
        return new UserList();
    }

    public function getLists($userId)
    {
        $user = User::where('id', $userId)->first();
        $teamUsers = $user->currentTeam->users->pluck('id')->toArray();
        return UserList::whereIn('user_id', $teamUsers)->get();
    }
}
