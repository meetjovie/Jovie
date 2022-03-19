<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublicProfileFieldsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('sub');
            $table->string('username')->nullable()->after('email');
            $table->string('call_to_action_text')->nullable()->after('username');
            $table->mediumText('call_to_action')->nullable()->after('call_to_action_text');
            $table->boolean('is_verified')->nullable()->after('call_to_action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
