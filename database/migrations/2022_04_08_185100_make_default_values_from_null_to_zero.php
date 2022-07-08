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
        Schema::table('crms', function (Blueprint $table) {
            $table->boolean('favourite')->default(0)->after('instagram_rating')->change();
            $table->boolean('muted')->default(0)->after('favourite')->change();
        });
        \App\Models\Crm::where('favourite', null)->update(['favourite' => 0]);
        \App\Models\Crm::where('muted', null)->update(['muted' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crms', function (Blueprint $table) {
            //
        });
    }
};
