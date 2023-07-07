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
        Schema::create('setting_attributes', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('user_list_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->uuid('team_id')->nullable();
            $table->uuid('setting_id');
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_attributes');
    }
};
