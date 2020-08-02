<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->string('medrec', 20)->unique();
            $table->string("nama", 30);
            $table->string("tempatLahir", 20);
            $table->date("tanggalLahir");
            $table->text("alamat", 50);
            $table->string("telepon", 15);
            $table->string("jenisKelamin", 10);
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
        Schema::dropIfExists('table_pasien');
    }
}
