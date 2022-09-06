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
        Schema::table('crms', function (Blueprint $table) {
            $table->dropColumn(['instagram_offer', 'instagram_archived', 'instagram_removed', 'twitter_offer', 'twitter_archived', 'twitter_removed', 'twitch_offer', 'twitch_archived', 'twitch_removed']);
            $table->double('offer', null, 2)->nullable()->after('last_contacted');
            $table->unsignedBigInteger('archived_list')->nullable()->after('offer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crms', function (Blueprint $table) {
            //
        });
    }
};
