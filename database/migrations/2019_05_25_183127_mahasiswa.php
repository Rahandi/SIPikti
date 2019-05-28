<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_pendaftaran')->nullable();
            $table->string('nama');
            $table->string('nama_gelar');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('nomor_handphone');
            $table->text('pendidikan_id');
            $table->integer('alamat_asal_id');
            $table->integer('alamat_surabaya_id');
            $table->integer('status_saat_mendaftar_id');
            $table->integer('sumber_informasi_id');
            $table->string('administrator')->nullable();
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
        Schema::dropIfExists('mahasiswa');
    }
}
