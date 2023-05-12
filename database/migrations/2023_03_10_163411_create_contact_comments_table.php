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
        Schema::create('contact_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                ->references('id')
                ->on(\Illuminate\Support\Facades\Config::get('teamwork.teams_table'));
            $table->longText('comment');
            $table->char('emoji')->nullable();
            $table->foreignId('deleted_by')->nullable()->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('contact_comments');
    }
};
