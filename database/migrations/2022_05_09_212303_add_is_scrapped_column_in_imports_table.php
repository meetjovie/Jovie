<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imports', function (Blueprint $table) {
            $table->boolean('instagram_scrapped')->default(false);
            $table->boolean('youtube_scrapped')->default(false);
            $table->boolean('twitter_scrapped')->default(false);
            $table->boolean('twitch_scrapped')->default(false);
            $table->boolean('onlyFans_scrapped')->default(false);
            $table->boolean('tiktok_scrapped')->default(false);
            $table->boolean('linkedin_scrapped')->default(false);
            $table->boolean('snapchat_scrapped')->default(false);
            $table->boolean('wikiId_scrapped')->default(false);
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
};
