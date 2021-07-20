<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPengunjung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pengunjung', function (Blueprint $table) {
            $table->string('nik',20)->primary();
            $table->string('nama_pengunjung');
            $table->string('alamat');
            $table->string('jenis_kelamin',15);
            $table->string('no_telpon',12);
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
        Schema::dropIfExists('tbl_pengunjung');
    }
}
