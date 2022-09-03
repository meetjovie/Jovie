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
        Schema::disableForeignKeyConstraints();
        Schema::table('crms', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropColumn('team_id');
        });
        Schema::table('crms', function (Blueprint $table) {
            $table->integer('team_id')->unsigned()->after('user_id');
            $table->foreign('team_id')
                ->references('id')
                ->on(\Illuminate\Support\Facades\Config::get('teamwork.teams_table'))->cascadeOnDelete()->cascadeOnUpdate();
        });
        $users = \App\Models\User::with('currentTeam')->get();
        foreach ($users as $user) {
            \App\Models\Crm::where('user_id', $user->id)->update(['team_id' => $user->currentTeam->id]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crms', function (Blueprint $table) {
            //
        });
    }
};
