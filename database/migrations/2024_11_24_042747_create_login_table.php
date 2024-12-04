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
        Schema::create('login', function (Blueprint $table) {
            $table->id('id_login'); // Primary key untuk tabel login
            $table->string('id_user'); // Foreign key mengacu ke tabel users
            $table->string('ip_address')->nullable(); // IP address pengguna saat login
            $table->string('user_agent')->nullable(); // Informasi perangkat atau browser
            $table->timestamp('login_at')->nullable(); // Waktu login
            $table->timestamp('logout_at')->nullable(); // Waktu logout
            $table->timestamps(); 

            // Foreign key constraint
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};
