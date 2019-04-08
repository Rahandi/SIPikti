<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusSaatMendaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_saat_mendaftar', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('lulus_sma');
            $table->smallInteger('mahasiswa');
            $table->smallInteger('bekerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_saat_mendaftar');
    }
}
