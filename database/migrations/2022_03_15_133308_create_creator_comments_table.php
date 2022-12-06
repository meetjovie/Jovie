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
        Schema::create('creator_comments', function (Blueprint $table) {
            $table->id();
           /*  $table->foreignId('creator_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); */
          /*   $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); */
            $table->longText('comment');
           /*  $table->foreignId('deleted_by')->nullable()->references('id')->on('users'); */
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
        Schema::dropIfExists('creator_comments');
    }
};
