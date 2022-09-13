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
        Schema::table('users', function (Blueprint $table) {
            $table->string('instagram_handler')->nullable();
            $table->string('twitter_handler')->nullable();
            $table->string('facebook_handler')->nullable();
            $table->string('youtube_handler')->nullable();
            $table->string('twitch_handler')->nullable();
            $table->string('spotify_handler')->nullable();
            $table->string('apple_music_handler')->nullable();
            $table->string('soundcloud_handler')->nullable();
            $table->string('linkedin_handler')->nullable();
            $table->string('tiktok_handler')->nullable();

            //
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
            $table->dropColumn('instagram_handler');
            $table->dropColumn('twitter_handler');
            $table->dropColumn('facebook_handler');
            $table->dropColumn('youtube_handler');
            $table->dropColumn('twitch_handler');
            $table->dropColumn('spotify_handler');
            $table->dropColumn('apple_music_handler');
            $table->dropColumn('soundcloud_handler');
            $table->dropColumn('linkedin_handler');
            $table->dropColumn('tiktok_handler');

            //
        });
    }
};
