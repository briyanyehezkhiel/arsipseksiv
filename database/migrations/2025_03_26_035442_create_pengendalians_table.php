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
        Schema::create('pengendalians', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun')->nullable();
            $table->text('jenis_hak')->nullable();
            $table->text('nomor')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->text('kota')->nullable();
            $table->text('kecamatan')->nullable();
            $table->text('kelurahan')->nullable();
            $table->text('luas_hak')->nullable();
            $table->text('penguasaan_tanah')->nullable();
            $table->text('penggunaan_tanah')->nullable();
            $table->text('pemanfaatan_tanah')->nullable();
            $table->text('terindikasi_terlantar', 10, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengendalians');
    }
};
