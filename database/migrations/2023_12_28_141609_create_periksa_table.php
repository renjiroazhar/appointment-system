<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('id_daftar_poli')->constrained('daftar_polis')->onDelete('cascade');
            $table->integer('id')->length(11)->autoIncrement();
            $table->integer('id_daftar_poli')->length(11)->references('id')->on('daftar_poli')->onDelete('cascade');
            // $table->date('tgl_periksa');
            // $table->string('catatan')->nullable();
            // $table->integer('biaya');
            $table->dateTime('tgl_periksa');
            $table->text('catatan');
            $table->integer('biaya_periksa')->length(11);
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
        Schema::dropIfExists('periksa');
    }
}
