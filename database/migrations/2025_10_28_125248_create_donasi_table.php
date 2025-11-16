<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->id('id_donasi');
            $table->string('username');
            $table->string('nama_donasi');
            $table->enum('jenis_barang', ['Alat Rumah Tangga', 'Sembako', 'Pakaian', 'Alat Tulis']);
            $table->string('jumlah_barang', 50);
            $table->string('lokasi')->nullable();
            $table->text('deskripsi');
            $table->string('nomor_telepon')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status_donasi', ['tersedia', 'tersalurkan'])->default('tersedia');
            $table->enum('hasil_verif', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('alasan_tolak')->nullable();
            $table->enum('status_edit', ['menunggu_edit', 'diedit', ''])->nullable();
            $table->timestamp('tanggal_upload')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
            Schema::dropIfExists('donasi');
            Schema::table('donasi', function (Blueprint $table) {
                $table->dropColumn('nomor_telepon');
        });
    }
};