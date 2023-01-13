<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFlyerProdutAllowDeleteProducts extends Migration
{
    public function up()
    {
        Schema::table('flyer_product', function (Blueprint $table) {
            $table->dropForeign(['product_id']);

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('flyer_product', function (Blueprint $table) {
            $table->dropForeign(['product_id']);

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products');
        });
    }
}
