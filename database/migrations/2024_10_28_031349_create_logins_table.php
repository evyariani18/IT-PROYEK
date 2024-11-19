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
        Schema::create('logins', function (Blueprint $table) {
            $table->id(); // ID otomatis
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kunci asing untuk pengguna
            $table->timestamp('login_at')->nullable(); // Waktu login
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logins'); // Menghapus tabel logins
    }
};
