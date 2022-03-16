<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewRelatedFieldsForSocialHandles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            Schema::table('creators', function (Blueprint $table) {
                $table->string('twitch_handler')->nullable()->after('instagram_meta');
                $table->string('onlyFans_handler')->nullable()->after('instagram_meta');
                $table->string('snapchat_handler')->nullable()->after('instagram_meta');
                $table->string('linkedin_handler')->nullable()->after('instagram_meta');
                $table->string('youtube_handler')->nullable()->after('instagram_meta');
                $table->string('twitter_handler')->nullable()->after('instagram_meta');
                $table->string('tiktok_handler')->nullable()->after('instagram_meta');
            });

            Schema::table('users', function (Blueprint $table) {
                $table->boolean('show_twitch')->default(true)->nullable();
                $table->boolean('show_onlyFans')->default(true)->nullable();
                $table->boolean('show_snapchat')->default(true)->nullable();
                $table->boolean('show_linkedin')->default(true)->nullable();
                $table->boolean('show_youtube')->default(true)->nullable();
                $table->boolean('show_twitter')->default(true)->nullable();
                $table->boolean('show_tiktok')->default(true)->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
