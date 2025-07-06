<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBalasanToKontaksTable extends Migration
{
    public function up()
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->text('balasan')->nullable()->after('pesan');
        });
    }

    public function down()
    {
        Schema::table('kontaks', function (Blueprint $table) {
            $table->dropColumn('balasan');
        });
    }
}
