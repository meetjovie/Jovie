<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsInCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->string('tiktok_name',200)->nullable();
            $table->string('state',200)->nullable();
            $table->integer('tiktok_followers')->nullable();
            $table->string('tiktok_biography',255)->nullable();
            $table->double('tiktok_engagement_rate',15,2)->nullable();
            $table->string('audience_countries',255)->nullable();
            $table->string('audience_states',255)->nullable();
            $table->string('day_30_percentage_growth',255)->nullable();
            $table->string('tiktok_meta',522)->nullable();
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
}
