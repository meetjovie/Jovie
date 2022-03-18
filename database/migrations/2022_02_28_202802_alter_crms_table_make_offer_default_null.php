<?php

use Doctrine\DBAL\Types\FloatType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;

class AlterCrmsTableMakeOfferDefaultNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crms', function (Blueprint $table) {
            if (!Type::hasType('double')) {
                Type::addType('double', FloatType::class);
            }
            $table->double('instagram_offer', null, 2)->nullable()->change();
            $table->renameColumn('instagram_rating', 'rating')->nullable()->change();

            \App\Models\Crm::where('instagram_offer', 0)->update(['instagram_offer' => null]);
        });
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
}
