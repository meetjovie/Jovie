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
        Schema::create('creators', function (Blueprint $table) {
            $table->id();
            $table->boolean('platform_verified')->default(false)->nullable();
            $table->string('platform_username')->nullable();
            $table->string('platform_title')->nullable();
            $table->string('platform_employer')->nullable();
            $table->string('platform_employer_link')->nullable();
            $table->string('first_name')->default(null)->nullable();
            $table->string('last_name')->default(null)->nullable();
            $table->string('full_name')->default(null)->nullable();
            $table->mediumText('emails')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('gender_accuracy')->default(0)->nullable();
          
            $table->boolean('gender_updated')->default(false)->nullable();
            $table->string('location')->index()->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
           
            $table->string('type')->nullable();
            
           
            $table->string('account_type')->nullable();
            $table->text('tags')->nullable();
            $table->text('social_links')->nullable();
            $table->string('instagram_handler')->index()->nullable();
            $table->string('instagram_name')->nullable();
            $table->string('instagram_category')->nullable();
            $table->boolean('instagram_name_updated')->default(false)->nullable();
            $table->float('instagram_followers', 20, 2)->nullable();
            $table->text('instagram_biography')->nullable();
            $table->string('instagram_email')->nullable();
            $table->double('instagram_engagement_rate')->index()->default(0);
            $table->boolean('instagram_is_verified')->index()->default(false);
            $table->boolean('instagram_is_private')->index()->default(false);
            $table->longText('instagram_media')->nullable();
            $table->longText('instagram_meta')->nullable();
            $table->string('wiki_id')->nullable();
            $table->string('twitch_handler')->nullable();
            $table->string('onlyFans_handler')->nullable();
            $table->string('snapchat_handler')->nullable();
            $table->string('linkedin_handler')->nullable();
            $table->string('youtube_handler')->nullable();
            $table->string('twitter_handler')->nullable();
            $table->string('twitter_name')->nullable();
            $table->string('twitter_category')->nullable();
            $table->boolean('twitter_name_update')->default(false)->nullable();
            $table->double('twitter_followers', 20, 2)->nullable();
            $table->text('twitter_biography')->fulltext()->collation('utf8_unicode_ci')->nullable();
            $table->double('twitter_engagement_rate')->index()->default(0)->nullable();
            $table->boolean('twitter_is_verified')->index()->default(false)->nullable();
            $table->boolean('twitter_is_private')->index()->default(false)->nullable();
            $table->longText('twitter_media')->nullable()->nullable();
            $table->longText('twitter_meta')->nullable()->nullable();
            $table->string('tiktok_handler')->nullable();
            $table->string('twitch_id')->index()->nullable();
            $table->string('twitch_name')->nullable()->index();
            $table->string('twitch_category')->nullable()->index();
            $table->string('twitch_biography')->nullable();
            $table->bigInteger('twitch_followers')->nullable();
            $table->bigInteger('twitch_average_viewers')->nullable();
            $table->text('twitch_meta')->nullable();
            $table->timestamp('instagram_last_scrapped_at')->nullable();

            
            /* $table->renameColumn('instagram_stage', 'stage'); */
           /*  Cant find the original column */
/* cant find
 
          
  

           
            
         /*    $table->foreignId('user_id')->nullable()
                ->references('id')
                ->on('users')
              ->onUpdate('cascade')
                ->onDelete('cascade'); */
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
        Schema::dropIfExists('creators');
    }
};
