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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('id_barang')->primary();
            $table->string('kode_barang');
            $table->string('name');
            $table->integer('stok');
            $table->decimal('harga', 15, 2);
            $table->string('deskripsi', 255)->nullable();
            $table->string('image');
            $table->string('id_merek');
            $table->foreign('id_merek')->references('id_merek')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->string('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};