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
            $table->integer('team_id')->unsigned()->after('user_id')->nullable();
            $table->foreign('team_id')
                ->references('id')
                ->on(\Illuminate\Support\Facades\Config::get('teamwork.teams_table'));
        });
        try {
            Schema::table('order_user_list', function (Blueprint $table) {
                $table->dropForeign(['user_list_id']);
                $table->dropForeign(['user_id']);
            });
        } catch (Exception $e) {}
        Schema::dropIfExists('order_user_list');
        Schema::create('user_list_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('user_list_id');
            $table->integer('order')->default(0);
            $table->boolean('pinned')->default(false);
            $table->timestamps();
        });

        $users = \App\Models\User::get();
        foreach ($users as $user) {
            $lists = UserList::getLists($user->id);
            $listIds = $lists->pluck('id')->toArray();
            foreach ($lists as $list) {
                $order = \Illuminate\Support\Facades\DB::table('order_user_list')
                    ->where('user_id', $user->id)
                    ->whereIn('user_list_id', $listIds)->max('order');
                $order = is_null($order) ? 0 : ($order + 1);
                $user->orderUserList()->syncWithoutDetaching([
                    $list->id => [
                        'order' => $order
                    ]
                ]);
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
