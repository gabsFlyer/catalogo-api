<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserAddHierarchy extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('users', 'hierarchy')) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('hierarchy');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'hierarchy')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('hierarchy');
            });
        }
    }
}
