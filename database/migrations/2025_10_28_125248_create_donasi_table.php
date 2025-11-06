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
            $table->increments('id_donasi');;

            // foreign key to pengguna
            $table->string('username', 30); 
            $table->foreign('username')
                ->references('username')
                ->on('pengguna')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // other fields
            $table->integer('jumlah_barang');
            $table->enum('jenis_barang', ['alat rumah tangga', 'sembako','pakaian','alat tulis','lain-lain'])->default('lain-lain');
            $table->text('deskripsi')->nullable();
            $table->string('nama_donasi', 100);
            $table->enum('status_donasi', ['tersedia', 'tersalurkan'])->default('tersedia');
            $table->enum('hasil_verif', ['disetujui', 'ditolak', 'menunggu'])->default('menunggu');
            $table->string('foto')->nullable();
            $table->date('tanggal_upload');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
