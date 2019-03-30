<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('nomor_pendaftaran')->unique();
            $table->string('nama');
            $table->string('nama_gelar');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->smallInteger('alamat_asal')->unique();
            $table->smallInteger('alamat_surabaya')->unique();
            $table->string('nomor_handphone');
            $table->text('pendidikan');
            $table->smallInteger('status_saat_mendaftar')->unique();
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
        Schema::dropIfExists('pendaftars');
    }
}
