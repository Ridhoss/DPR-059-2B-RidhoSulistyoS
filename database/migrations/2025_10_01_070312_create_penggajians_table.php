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
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota');
            $table->unsignedBigInteger('id_komponen_gaji');
            $table->timestamps();

            $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_komponen_gaji')->references('id_komponen_gaji')->on('komponen_gajis')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
