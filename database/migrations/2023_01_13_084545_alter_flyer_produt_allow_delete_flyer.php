<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFlyerProdutAllowDeleteFlyer extends Migration
{
    public function up()
    {
        Schema::table('flyer_product', function (Blueprint $table) {
            $table->dropForeign(['flyer_id']);

            $table->foreign('flyer_id')
                  ->references('id')
                  ->on('flyers')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('flyer_product', function (Blueprint $table) {
            $table->dropForeign(['flyer_id']);

            $table->foreign('flyer_id')
                  ->references('id')
                  ->on('flyers');
        });
    }
}
