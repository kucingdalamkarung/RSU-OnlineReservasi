<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Antrian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string("medrec", 20);
            $table->string("noAntri");
            $table->string("poli");
            $table->string("dokter", 10);
            $table->string("penjamin", 10);
            $table->date("tanggalKunjungan");
            $table->timestamps();

            $table->foreign("medrec")->references("medrec")->on("pasien");
            $table->foreign("poli")->references("noPoli")->on("poliklinik");
            $table->foreign("dokter")->references("kodeDokter")->on("dokter");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antrian');
    }
}

