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
            $table->string('type');
            $table->integer('order')->default(0);
            $table->string('value')->default(false);
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
