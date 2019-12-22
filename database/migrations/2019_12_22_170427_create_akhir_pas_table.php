<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAkhirPasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akhir_pas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jadwal_id');
            $table->string('mahasiswa_id');
            $table->string('judul')->nullable();
            $table->string('pembimbing')->nullable();
            $table->string('nilai')->nullable();
            $table->integer('tahun');
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
        Schema::dropIfExists('akhir_pas');
    }
}
