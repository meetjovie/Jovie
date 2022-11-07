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
            $table->string('tiktok_name')->nullable()->after('tiktok_handler');
            $table->string('tiktok_category')->nullable()->after('tiktok_name');
            $table->boolean('tiktok_name_update')->default(false)->nullable()->after('tiktok_category');

            $table->double('tiktok_followers', 20, 2)->nullable()->after('tiktok_name_update');
            $table->text('tiktok_biography')->fulltext()->nullable()->after('tiktok_followers');
            $table->double('tiktok_engagement_rate')->index()->default(0)->nullable()->after('tiktok_biography');
            $table->boolean('tiktok_is_verified')->index()->default(false)->nullable()->after('tiktok_engagement_rate');
            $table->boolean('tiktok_is_private')->index()->default(false)->nullable()->after('tiktok_is_verified');
            $table->longText('tiktok_media')->nullable()->nullable()->after('tiktok_is_private');
            $table->longText('tiktok_meta')->nullable()->nullable()->after('tiktok_media');
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
