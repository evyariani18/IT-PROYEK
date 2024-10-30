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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id_transaksi')->primary(); // ID unik untuk transaksi
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Menambahkan foreign key untuk pengguna
            $table->integer('jumlah'); // Jumlah barang
            $table->decimal('harga_satuan', 10, 2); // Harga per unit
            $table->decimal('harga_total', 10, 2); // Total harga (jumlah * harga satuan)
            $table->date('tanggal_transaksi'); // Tanggal transaksi
            $table->string('keterangan')->nullable(); // Keterangan tambahan
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi'); // Menghapus tabel jika migrasi dibatalkan
    }
};
