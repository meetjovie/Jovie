<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creator_user_list', function (Blueprint $table) {
            $table->id();
            /* $table->foreignId('creator_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_list_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); */
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
        Schema::dropIfExists('creator_user_list');
    }
};
