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
        Schema::create('komponen_gajis', function (Blueprint $table) {
            $table->id('id_komponen_gaji');
            $table->string('nama_komponen');
            $table->enum('kategori', ['Gaji Pokok', 'Tunjangan Melekat', 'Tunjangan Lain']);
            $table->enum('jabatan', ['Ketua', 'Wakil Ketua', 'Anggota', 'Semua']);
            $table->decimal('nominal', 17,2);
            $table->string('satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komponen_gajis');
    }
};
