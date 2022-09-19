<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('duplicateList.{listId}', function ($user, $listId) {
    $list = \App\Models\UserList::where('id', $listId)->first();
    $user = \App\Models\User::with('currentTeam')->where('id', $user->id)->first();
    if ($list && ($list->user_id == $user->id) && ($list->team_id == $user->currentTeam->id)) {
        return true;
    } elseif ($list && ($list->team_id == $user->currentTeam->id)) {
        // notification trail
    }
    return false;
});
Broadcast::channel('creatorImported.{teamId}', function ($user, $teamId) {
    $user = $user->load('currentTeam');
    return $user->currentTeam->id == $teamId;
});

Broadcast::channel('importListCreated.{teamId}', function ($user, $teamId) {
    $user = $user->load('currentTeam');
    return $user->currentTeam->id == $teamId;
});
