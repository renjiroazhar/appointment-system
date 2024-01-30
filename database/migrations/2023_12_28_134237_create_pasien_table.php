<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            // $table->id();
            $table->integer('id')->length(11)->autoIncrement();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_ktp')->unique();
            // $table->string('no_hp');
            // $table->string('no_rm')->nullable();
            $table->string('no_hp')->length(50);
            $table->string('no_rm')->length(25)->nullable();
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
        Schema::dropIfExists('pasien');
    }
}
