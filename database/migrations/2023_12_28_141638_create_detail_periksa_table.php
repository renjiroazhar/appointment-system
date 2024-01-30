<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPeriksaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_periksa', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('id_dokter')->constrained('dokters')->onDelete('cascade');
            // $table->foreignId('id_periksa')->constrained('periksas')->onDelete('cascade');
            // $table->foreignId('id_obat')->constrained('obats')->onDelete('cascade');
            $table->integer('id')->length(11)->autoIncrement();
            $table->integer('id_dokter')->length(11)->references('id')->on('dokter')->onDelete('cascade');
            $table->integer('id_periksa')->length(11)->references('id')->on('periksa')->onDelete('cascade');
            $table->integer('id_obat')->length(11)->references('id')->on('obat')->onDelete('cascade');
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
        Schema::dropIfExists('detail_periksa');
    }
}
