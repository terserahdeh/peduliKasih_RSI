<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->increments('id_komentar'); // int(10) unsigned + auto_increment

            $table->unsignedBigInteger('id_donasi'); // MATCH dengan donasi.id_donasi
            $table->unsignedInteger('id_akun');   // relasi ke pengguna.id_akun
            $table->unsignedBigInteger('id_parent')->nullable();

            $table->text('isi_komentar');
            $table->timestamps();

            // foreign key ke donasi
            $table->foreign('id_donasi')
                ->references('id_donasi')
                ->on('donasi')
                ->onDelete('cascade');

            // foreign key ke pengguna
            $table->foreign('id_akun')
                ->references('id_akun')
                ->on('pengguna')
                ->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('komentar');
    }
};