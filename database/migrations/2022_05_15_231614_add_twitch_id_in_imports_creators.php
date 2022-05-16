<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwitchIdInImportsCreators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->string('twitch_id')->after('twitch_handler')->index()->nullable();
        });
        Schema::table('imports', function (Blueprint $table) {
            $table->string('twitch_id')->after('twitch')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imports_creators', function (Blueprint $table) {
            //
        });
    }
}
