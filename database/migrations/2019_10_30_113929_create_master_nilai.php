<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_nilai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('termin');
            $table->tinyInteger('id_jadwal');
            $table->tinyInteger('id_mk');
            $table->integer('jumlah_penilaian');
            $table->text('nama_penilaian');
            $table->text('persen_penilaian');
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
        Schema::dropIfExists('master_nilai');
    }
}
