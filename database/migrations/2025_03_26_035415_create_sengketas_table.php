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
        Schema::create('sengketas', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun')->nullable();
            $table->text('pemohon')->nullable();
            $table->text('termohon')->nullable();
            $table->text('objek')->nullable();
            $table->text('pokok_masalah')->nullable();
            $table->text('progress_penyelesaian')->nullable();
            $table->text('konseptor')->nullable();
            $table->text('k1')->nullable();
            $table->text('k2')->nullable();
            $table->text('k3')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sengketas');
    }
};
