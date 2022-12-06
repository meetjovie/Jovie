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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->index();
            $table->string('username')->nullable();
            $table->string('title')->nullable();
            $table->string('employer')->nullable();
            $table->string('employer_link')->nullable();
            $table->string('call_to_action_text')->nullable();
            $table->mediumText('call_to_action')->nullable();
            $table->boolean('is_verified')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->text('profile_pic_url')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('show_instagram')->default(true)->nullable();
            $table->boolean('show_twitch')->default(true)->nullable();
            $table->boolean('show_onlyFans')->default(true)->nullable();
            $table->boolean('show_snapchat')->default(true)->nullable();
            $table->boolean('show_linkedin')->default(true)->nullable();
            $table->boolean('show_youtube')->default(true)->nullable();
            $table->boolean('show_twitter')->default(true)->nullable();
            $table->boolean('show_tiktok')->default(true)->nullable();
            $table->integer('queued_count')->nullable()->default(0);
          
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
