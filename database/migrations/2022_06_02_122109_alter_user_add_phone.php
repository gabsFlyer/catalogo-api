<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserAddPhone extends Migration
{
    private $table = 'users';

    public function up()
    {
        if (!Schema::hasColumn($this->table, 'phone')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->string('phone');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn($this->table, 'phone')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('phone');
            });
        }
    }
}
