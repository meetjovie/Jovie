<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandCreatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_creator', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id')->references('id')->on('creators')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('creators')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('brand_creator');
    }
}
