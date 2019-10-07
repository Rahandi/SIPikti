<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNohpEmailToMasterAsisten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_asisten', function (Blueprint $table) {
            $table->string('nohp')->after('nama')->nullable();
            $table->string('email')->before('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_asisten', function (Blueprint $table) {
            //
        });
    }
}
