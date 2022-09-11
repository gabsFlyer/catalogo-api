<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFlyerAddInitialDate extends Migration
{
    public function up()
    {
        Schema::table('flyers', function (Blueprint $table) {
            $table->renameColumn('valid_until', 'final_date');
            $table->date('initial_date');
        });
    }

    public function down()
    {
        Schema::table('flyers', function (Blueprint $table) {
            $table->renameColumn('final_date', 'valid_until');
            $table->dropColumn('initial_date');
        });
    }
}
