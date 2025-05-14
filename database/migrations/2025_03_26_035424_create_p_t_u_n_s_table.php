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
        Schema::create('p_t_u_n_s', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun')->nullable();
            $table->text('lokus_dan_register_perkara')->nullable();
            $table->text('penggugat')->nullable();
            $table->text('tergugat')->nullable();
            $table->text('objek_perkara_letak')->nullable();
            $table->text('tk1')->nullable();
            $table->text('banding')->nullable();
            $table->text('kasasi')->nullable();
            $table->text('pk')->nullable();
            $table->text('amar_putusan_akhir')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_t_u_n_s');
    }
};
