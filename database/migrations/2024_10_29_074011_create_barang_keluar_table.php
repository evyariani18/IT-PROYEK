<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangKeluarTable extends Migration
{
    public function up()
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->string('id');
            $table->string('id_keluar')->primary(); // Primary key
            $table->string('id_barang'); // Foreign key
            $table->string('name'); // Nama barang
            $table->integer('jumlah'); // Jumlah barang keluar
            $table->decimal('harga_satuan', 10, 2); // Harga per unit
            $table->decimal('harga_total', 10, 2); // Total harga
            $table->date('tanggal_keluar'); // Tanggal keluar
            $table->text('keterangan')->nullable(); // Keterangan
            $table->timestamps(); // Waktu buat dan update

            // Menambahkan foreign key constraint
            $table->foreign('id_barang')->references('id_barang')->on('barangs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang_keluar');
    }
}
