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
        Schema::table('creators', function (Blueprint $table) {
            $table->boolean('platform_verified')->default(false)->nullable()->after('id');
            $table->string('platform_username')->nullable()->after('platform_verified');
            $table->string('platform_title')->nullable()->after('platform_username');
            $table->string('platform_employer')->nullable()->after('platform_title');
            $table->string('platform_employer_link')->nullable()->after('platform_employer');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->nullable()->after('username');
            $table->string('employer')->nullable()->after('title');
            $table->string('employer_link')->nullable()->after('employer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creators', function (Blueprint $table) {
            //
        });
    }
};
