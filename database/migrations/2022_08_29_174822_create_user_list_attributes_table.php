<?php

use App\Models\UserList;
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
        Schema::table('user_lists', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropColumn('team_id');
        });
        Schema::table('user_lists', function (Blueprint $table) {
            $table->integer('team_id')->unsigned()->after('user_id');
            $table->foreign('team_id')
                ->references('id')
                ->on(\Illuminate\Support\Facades\Config::get('teamwork.teams_table'))->cascadeOnDelete()->cascadeOnUpdate();
        });
        $lists = UserList::get();
        foreach ($lists as $list) {
            if ($list->id == 17) {

                $list->team_id = 4;
                $list->save();
                continue;
            }
            $user = \App\Models\User::with('currentTeam')->where('id', $list->user_id)->first();
            if ($user) {
                $list->team_id = $user->currentTeam->id;
                $list->save();
            }
        }
        try {
            Schema::table('order_user_list', function (Blueprint $table) {
                $table->dropForeign(['user_list_id']);
                $table->dropForeign(['user_id']);
            });
        } catch (Exception $e) {}
        Schema::dropIfExists('order_user_list');
        try {
            Schema::table('user_list_attributes', function (Blueprint $table) {
                $table->dropForeign(['user_list_id']);
                $table->dropForeign(['user_id']);
            });
        } catch (Exception $e) {}
        Schema::dropIfExists('user_list_attributes');
        Schema::create('user_list_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('team_id');
            $table->foreign('team_id')
                ->references('id')
                ->on(\Config::get('teamwork.teams_table'))
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('user_list_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('order')->default(0);
            $table->boolean('pinned')->default(false);
            $table->timestamps();
        });

        $users = \App\Models\User::with('teams')->get();
        foreach ($users as $user) {
            foreach ($user->teams as $team) {
                $lists = UserList::getListsByTeam($team->id);
                $listIds = $lists->pluck('id')->toArray();
                foreach ($lists as $list) {
                    $order = \Illuminate\Support\Facades\DB::table('user_list_attributes')
                        ->where('user_id', $user->id)
                        ->whereIn('user_list_id', $listIds)->max('order');
                    $order = is_null($order) ? 0 : ($order + 1);
                    $user->userListAttributes()->syncWithoutDetaching([
                        $list->id => [
                            'order' => $order,
                            'team_id' => $team->id
                        ]
                    ]);
                }
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
        Schema::dropIfExists('user_list_attributes');
    }
};
