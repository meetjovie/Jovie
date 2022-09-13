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
        Schema::create('order_user_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('user_list_id');
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('order_user_list');
    }
};
