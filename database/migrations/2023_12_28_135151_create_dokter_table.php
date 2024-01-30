<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            // $table->id();
            $table->integer('id')->length(11)->autoIncrement();
            $table->string('nama');
            $table->string('alamat');
            // $table->string('no_hp')->unique();
            $table->string('no_hp')->length(50);
            $table->string('password');
            // $table->foreignId('id_poli')->constrained('polis')->onDelete('cascade');
            $table->integer('id_poli')->length(11)->references('id')->on('poli')->onDelete('cascade');
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
        Schema::dropIfExists('dokter');
    }
}
