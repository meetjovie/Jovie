<?php

namespace App\Observers;

use App\Models\Team;
use App\Models\User;
use App\Models\UserList;
use Illuminate\Support\Facades\DB;

class TeamObserver
{
    /**
     * Handle the Team "created" event.
     *
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function created(Team $team)
    {
        //
    }

    /**
     * Handle the Team "updated" event.
     *
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function updated(Team $team)
    {
        //
    }

    /**
     * Handle the Team "deleted" event.
     *
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function deleted(Team $team)
    {
        try {
            DB::table('crms')->where('team_id', $team->id)->delete();
            DB::table('imports')->where('team_id', $team->id)->delete();
            DB::table('notifications')->where('team_id', $team->id)->delete();
            DB::table('team_invites')->where('team_id', $team->id)->delete();
            DB::table('team_user')->where('team_id', $team->id)->delete();
            UserList::where('team_id', $team->id)->delete();

            $currentSubscription = $team->currentSubscription();
            if ($currentSubscription) {
                $team->subscription($currentSubscription->name)->cancel();
            }

        } catch (\Exception $e) {

        }
    }

    /**
     * Handle the Team "restored" event.
     *
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function restored(Team $team)
    {
        //
    }

    /**
     * Handle the Team "force deleted" event.
     *
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function forceDeleted(Team $team)
    {
        //
    }
}
