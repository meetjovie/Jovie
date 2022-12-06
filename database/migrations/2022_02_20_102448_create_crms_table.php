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
        Schema::create('crms', function (Blueprint $table) {
            $table->id();
          /*   $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('creator_id')->constrained()->onDelete('cascade')->onUpdate('cascade'); */
            $table->dateTime('last_contacted')->nullable();
            $table->double('instagram_offer', null, 2)->nullable();
            $table->integer('instagram_stage')->default(0);
            $table->double('rating')->nullable();
            $table->boolean('favourite')->default(0);
            $table->boolean('muted')->default(0);
            $table->boolean('instagram_archived')->nullable();
            $table->boolean('instagram_removed')->nullable();
            $table->timestamps();

           

           /*  DB::statement('ALTER TABLE crms MODIFY COLUMN archived TINYINT(1) AFTER instagram_stage'); */

          /*   if (! Type::hasType('double')) {
                Type::addType('double', FloatType::class);
            } */
           
           

           
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crms');
    }
};
