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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                ->references('id')
                ->on(\Illuminate\Support\Facades\Config::get('teamwork.teams_table'));
            $table->foreignId('user_list_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company')->nullable();
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->text('emails')->nullable();
            $table->string('website')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('gender')->nullable();

            $table->date('last_contacted')->nullable();
            $table->double('offer', null, 2)->nullable();
            $table->boolean('archived')->default(false);
            $table->double('rating', null, 2)->default(0);
            $table->integer('stage')->default(0);
            $table->boolean('favourite')->default(0);
            $table->boolean('muted')->default(0);
            $table->string('source')->nullable();
            $table->text('description')->nullable();
            $table->uuid('description_updated_by')->nullable();

            $table->string('instagram')->nullable();
            $table->longText('instagram_data')->nullable();
            $table->string('twitter')->nullable();
            $table->longText('twitter_data')->nullable();
            $table->string('linkedin')->nullable();
            $table->longText('linkedin_data')->nullable();
            $table->string('tiktok')->nullable();
            $table->longText('tiktok_data')->nullable();
            $table->string('twitch')->nullable();
            $table->longText('twitch_data')->nullable();
            $table->string('youtube')->nullable();
            $table->longText('youtube_data')->nullable();
            $table->string('snapchat')->nullable();
            $table->longText('snapchat_data')->nullable();
            $table->string('onlyfans')->nullable();
            $table->longText('onlyfans_data')->nullable();
            $table->string('wiki')->nullable();
            $table->longText('wiki_data')->nullable();

            $table->dateTime('last_enriched_at')->nullable();

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
        Schema::dropIfExists('contacts');
    }
};
