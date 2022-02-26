<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCrmsTableAddInteractionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crms', function (Blueprint $table) {
            $table->double('instagram_rating')->nullable()->after('instagram_stage');
            $table->boolean('favourite')->nullable()->after('instagram_rating');
            $table->boolean('muted')->nullable()->after('favourite');
            $table->boolean('archived')->nullable()->after('muted');
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
}
