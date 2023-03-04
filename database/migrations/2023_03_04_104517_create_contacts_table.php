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
            $table->foreignId('creator_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('last_contacted')->nullable();
            $table->double('offer', null, 2)->nullable()->after('last_contacted');
            $table->boolean('archived')->default(false);
            $table->double('rating');
            $table->integer('stage')->default(0);
            $table->boolean('favourite')->default(0)->after('instagram_rating')->change();
            $table->boolean('muted')->default(0)->after('favourite')->change();
            $table->boolean('selected')->default(0)->nullable();
            $table->boolean('rejected')->default(0)->nullable();
            $table->string('source')->nullable();
            $table->text('description')->nullable();
            $table->uuid('description_updated_by')->nullable();
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
