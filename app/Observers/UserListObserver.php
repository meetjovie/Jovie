<?php

namespace App\Observers;

use App\Models\UserList;
use Illuminate\Support\Facades\DB;

class UserListObserver
{
    /**
     * Handle the UserList "created" event.
     *
     * @param  \App\Models\UserList  $userList
     * @return void
     */
    public function created(UserList $userList)
    {
        //
    }

    /**
     * Handle the UserList "updated" event.
     *
     * @param  \App\Models\UserList  $userList
     * @return void
     */
    public function updated(UserList $userList)
    {
        //
    }

    /**
     * Handle the UserList "deleted" event.
     *
     * @param  \App\Models\UserList  $userList
     * @return void
     */
    public function deleted(UserList $userList)
    {
        try {
            DB::table('creator_user_list')->where('user_list_id', $userList->id)->delete();
            DB::table('imports')->where('user_list_id', $userList->id)->delete();
            DB::table('user_list_attributes')->where('user_list_id', $userList->id)->delete();

            UserList::updateSortOrder(null, $userList->user_id);
        } catch (\Exception $e) {

        }
    }

    /**
     * Handle the UserList "restored" event.
     *
     * @param  \App\Models\UserList  $userList
     * @return void
     */
    public function restored(UserList $userList)
    {
        //
    }

    /**
     * Handle the UserList "force deleted" event.
     *
     * @param  \App\Models\UserList  $userList
     * @return void
     */
    public function forceDeleted(UserList $userList)
    {
        //
    }
}
