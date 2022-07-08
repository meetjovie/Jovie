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
            $table->unsignedInteger('gender_accuracy')->default(0)->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('account_type')->nullable()->change();
            $table->text('instagram_biography')->nullable()->change();

            $table->string('twitter_name')->nullable()->after('twitter_handler');
            $table->string('twitter_category')->nullable()->after('twitter_name');
            $table->boolean('twitter_name_update')->default(false)->nullable()->after('twitter_category');

            $table->double('twitter_followers', 20, 2)->nullable()->after('twitter_name_update');
            $table->text('twitter_biography')->fulltext()->nullable()->after('twitter_followers');
            $table->double('twitter_engagement_rate')->index()->default(0)->nullable('twitter_biography');
            $table->boolean('twitter_is_verified')->index()->default(false)->nullable('twitter_engagement_rate');
            $table->boolean('twitter_is_private')->index()->default(false)->nullable('twitter_is_verified');
            $table->longText('twitter_media')->nullable()->nullable('twitter_is_private');
            $table->longText('twitter_meta')->nullable()->nullable('twitter_media');
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
