<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDispatchedColumnsInImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imports', function (Blueprint $table) {
            $table->boolean('instagram_dispatched')->default(false);
            $table->boolean('youtube_dispatched')->default(false);
            $table->boolean('twitter_dispatched')->default(false);
            $table->boolean('twitch_dispatched')->default(false);
            $table->boolean('onlyFans_dispatched')->default(false);
            $table->boolean('tiktok_dispatched')->default(false);
            $table->boolean('linkedin_dispatched')->default(false);
            $table->boolean('snapchat_dispatched')->default(false);
            $table->boolean('wikiId_dispatched')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imports', function (Blueprint $table) {
            //
        });
    }
}
