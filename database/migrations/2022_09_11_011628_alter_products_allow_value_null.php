<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductsAllowValueNull extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('wholesale_price')->nullable()->change();
            $table->integer('wholesale_minimum_quantity')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('wholesale_price')->change();
            $table->integer('wholesale_minimum_quantity')->change();
        });
    }
}
