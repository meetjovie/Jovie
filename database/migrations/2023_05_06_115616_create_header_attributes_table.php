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
        Schema::create('header_attributes', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->uuid('team_id');
            $table->uuid('user_list_id')->nullable();
            $table->uuid('header_id');
            $table->string('type');
            $table->integer('order')->default(0);
            $table->boolean('hide')->default(false);
            $table->integer('width')->default(160);
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
        Schema::dropIfExists('header_attributes');
    }
};
