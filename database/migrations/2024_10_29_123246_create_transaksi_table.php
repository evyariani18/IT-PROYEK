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
            $table->string('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barangs')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah'); // Jumlah barang
            $table->decimal('harga_satuan'); // Harga per unit
            $table->decimal('harga_total'); // Total harga (jumlah * harga satuan)
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
