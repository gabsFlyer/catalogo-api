<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFlyerProductAddOfferPrice extends Migration
{
    public function up()
    {
        Schema::table('flyer_product', function (Blueprint $table) {
            $table->decimal('offer_price', $precision = 8, $scale = 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('flyer_product', function (Blueprint $table) {
            $table->dropColumn('offer_price');
        });
    }
}
