<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creators', function (Blueprint $table) {
            $table->id();
            $table->mediumText('emails')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('gender_accuracy')->default(0)->nullable();
            $table->boolean('gender_updated')->default(false)->nullable();
            $table->string('location')->index()->nullable();
            $table->string('type');
            $table->string('account_type');
            $table->text('tags')->nullable();
            $table->text('social_links')->nullable();
            $table->string('instagram_handler')->index()->nullable();
            $table->string('instagram_name')->fulltext()->nullable();
            $table->string('instagram_category')->fulltext()->nullable();
            $table->boolean('instagram_name_updated')->default(false)->nullable();
            $table->double('instagram_followers', 20, 2);
            $table->text('instagram_biography')->fulltext();
            $table->string('instagram_email')->nullable();
            $table->double('instagram_engagement_rate')->index()->default(0);
            $table->boolean('instagram_is_verified')->index()->default(false);
            $table->boolean('instagram_is_private')->index()->default(false);
            $table->longText('instagram_media')->nullable();
            $table->longText('instagram_meta')->nullable();
            $table->foreignId('user_id')->nullable()
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
}
