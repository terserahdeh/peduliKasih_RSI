<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('request_donasi', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('tanggal_upload');
        });
    }

    public function down(): void
    {
        Schema::table('request_donasi', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
