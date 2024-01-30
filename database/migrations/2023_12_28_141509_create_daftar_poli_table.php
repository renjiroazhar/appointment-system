<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarPoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_poli', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('id_pasien')->constrained('pasiens')->onDelete('cascade');
            // $table->foreignId('id_jadwal')->constrained('jadwals')->onDelete('cascade');
            $table->integer('id')->length(11)->autoIncrement();
            $table->integer('id_pasien')->length(11)->references('id')->on('pasien')->onDelete('cascade');
            $table->integer('id_jadwal')->length(11)->references('id')->on('jadwal')->onDelete('cascade');
            // $table->string('keluhan');
            $table->text('keluhan');
            $table->integer('no_antrian')->length(10)->unsigned();
            $table->tinyInteger('status_periksa')->length(1);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_poli');
    }
}
