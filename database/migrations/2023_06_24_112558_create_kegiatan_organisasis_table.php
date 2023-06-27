<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('kegiatan_organisasis')) {
            Schema::create('kegiatan_organisasis', function (Blueprint $table) {
                $table->id();
                $table->string('nama_org');
                $table->string('nama_kegiatan');
                $table->string('tempat_kegiatan');
                $table->date('tanggal_kegiatan');
                $table->string('foto_kegiatan');
                $table->string('pelaksana');
                $table->string('penanggung_jawab');
                $table->text('deskripsi');
                $table->timestamps();
            });
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_organisasis');
    }
};
