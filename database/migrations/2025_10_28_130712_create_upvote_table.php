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
        Schema::create('upvote', function (Blueprint $table) {
            $table->id('id_upvote');
    
            // who upvoted
            $table->string('username', 30);
            $table->foreign('username')->references('username')->on('pengguna')->onDelete('cascade');
            
            // which request
            $table->unsignedInteger('id_request');
            $table->foreign('id_request')->references('id_request')->on('request_donasi')->onDelete('cascade');
            
            // prevent duplicate upvotes by same user
            $table->unique(['username', 'id_request']);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upvote');
    }
};
