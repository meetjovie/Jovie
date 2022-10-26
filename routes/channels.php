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

Broadcast::channel('userListDuplicated.{teamId}', function ($user, $teamId) {
    $user = $user->load('currentTeam');
    return $user->currentTeam->id == $teamId;
});
Broadcast::channel('creatorImported.{teamId}', function ($user, $teamId) {
    $user = $user->load('currentTeam');
    return $user->currentTeam->id == $teamId;
});

Broadcast::channel('importListCreated.{teamId}', function ($user, $teamId) {
    $user = $user->load('currentTeam');
    return $user->currentTeam->id == $teamId;
});

Broadcast::channel('notification.{teamId}', function ($user, $teamId) {
    $user = $user->load('currentTeam');
    return $user->currentTeam->id == $teamId;
});

Broadcast::channel('userListImported.{teamId}', function ($user, $teamId) {
    $user = $user->load('currentTeam');
    return $user->currentTeam->id == $teamId;
});

Broadcast::channel('userListImportTriggered.{teamId}', function ($user, $teamId) {
    $user = $user->load('currentTeam');
    return $user->currentTeam->id == $teamId;
});
