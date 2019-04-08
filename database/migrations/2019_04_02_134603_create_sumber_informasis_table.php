<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSumberInformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sumber_informasi', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('koran');
            $table->smallInteger('spanduk');
            $table->smallInteger('brosur');
            $table->smallInteger('teman_saudara');
            $table->smallInteger('pameran');
            $table->smallInteger('lainnya');
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
        Schema::dropIfExists('sumber_informasi');
    }
}
