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
        Schema::create('template_headers', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('user_id')->nullable();
            $table->uuid('team_id')->nullable();
            $table->uuid('template_id');
            $table->uuid('header_id');
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
        Schema::dropIfExists('template_headers');
    }
};
