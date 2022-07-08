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
        Schema::table('creators', function (Blueprint $table) {
            $table->string('twitch_name')->nullable()->index()->after('twitch_id');
            $table->string('twitch_category')->nullable()->index()->after('twitch_name');
            $table->string('twitch_biography')->nullable()->after('twitch_category');
            $table->bigInteger('twitch_followers')->nullable()->after('twitch_biography');
            $table->bigInteger('average_viewers')->nullable()->after('twitch_biography');
            $table->text('twitch_meta')->nullable()->after('twitch_biography');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creators', function (Blueprint $table) {
            //
        });
    }
};
