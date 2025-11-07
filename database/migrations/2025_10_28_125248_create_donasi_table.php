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
        Schema::create('donasi', function (Blueprint $table) {
            $table->id('id_donasi');
            $table->string('username');
            $table->string('jumlah_barang');
            $table->string('jenis_barang');
            $table->text('deskripsi');
            $table->string('nama_donasi');
            $table->enum('status_donasi', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('hasil_verif')->nullable();
            $table->string('foto');
            $table->date('tanggal_upload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};