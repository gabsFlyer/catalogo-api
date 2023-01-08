<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFlyerAllowFinalDateNull extends Migration
{
    public function up()
    {
        Schema::table('flyers', function (Blueprint $table) {
            $table->integer('final_date')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('flyers', function (Blueprint $table) {
            $table->integer('final_date')->change();
        });
    }
}
