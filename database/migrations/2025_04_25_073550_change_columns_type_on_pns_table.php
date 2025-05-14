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
        Schema::table('p_n_s', function (Blueprint $table) {
            $table->string('tk1')->nullable()->change();
            $table->string('banding')->nullable()->change();
            $table->string('kasasi')->nullable()->change();
            $table->string('pk')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('p_n_s', function (Blueprint $table) {
            $table->integer('tk1')->nullable()->change();
            $table->integer('banding')->nullable()->change();
            $table->integer('kasasi')->nullable()->change();
            $table->integer('pk')->nullable()->change();
        });
    }
};
