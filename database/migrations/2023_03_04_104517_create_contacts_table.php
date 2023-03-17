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

            $table->string('full_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('suffix')->nullable();
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->string('biography')->nullable();
            $table->string('phone')->nullable();
            $table->text('emails')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('profile_pic_url')->nullable();

            $table->date('last_contacted')->nullable();
            $table->double('offer', null, 2)->nullable();
            $table->boolean('archived')->default(false);
            $table->double('rating', null, 2)->default(0);
            $table->integer('stage')->default(0);
            $table->boolean('favourite')->default(0);
            $table->boolean('muted')->default(0);
            $table->string('source')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('description_updated_by')->nullable()->constrained('users');

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
