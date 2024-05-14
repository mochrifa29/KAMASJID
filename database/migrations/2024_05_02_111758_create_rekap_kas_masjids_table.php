<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_rekap_kas_masjid', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->references('id')->on('tb_kategori');
            $table->string('uraian');
            $table->date('tanggal');
            $table->integer('masuk');
            $table->integer('keluar');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_rekap_kas_masjid');
    }
};
