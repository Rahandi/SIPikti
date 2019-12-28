<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwalS', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tanggals');
            $table->string('bagian');
            $table->string('ids_mk');
            $table->string('ids_dosen');
            $table->string('ids_asisten');
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
        Schema::dropIfExists('jadwalS');
    }
}
