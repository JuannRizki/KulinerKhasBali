<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatingToPesanansTableV2 extends Migration


{
    public function up()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->tinyInteger('rating')->nullable();
        });
    }
    

    public function down()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('rating'); // Menghapus kolom rating
        });
    }
}
