<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat', function (Blueprint $table) {
            // $table->id();
            // $table->string('nama_obat');
            // $table->string('kemasan');
            // $table->integer('harga');
            $table->integer('id')->length(11)->autoIncrement();
            $table->string('kemasan')->length(35);
            $table->integer('harga')->length(11);
            // $table->timestamps();
        });

        DB::statement('ALTER TABLE `obat` ADD `nama_obat` VARBINARY(255)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `obat` DROP COLUMN `nama_obat`');

        Schema::dropIfExists('obat');
    }
}
