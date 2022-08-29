<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_lists', function (Blueprint $table) {
            $table->integer('team_id')->unsigned()->after('user_id')->nullable();
            $table->foreign('team_id')
                ->references('id')
                ->on(\Illuminate\Support\Facades\Config::get('teamwork.teams_table'));
        });

        $lists = \App\Models\UserList::get();
        foreach ($lists as $list) {
            $user = \App\Models\User::with('currentTeam')->where('id', $list->user_id)->first();
            if ($user) {
                dump($user->currentTeam->id);
                $list->team_id = $user->currentTeam->id;
                $list->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_lists', function (Blueprint $table) {
            //
        });
    }
};
