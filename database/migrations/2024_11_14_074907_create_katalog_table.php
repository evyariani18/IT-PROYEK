<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katalog', function (Blueprint $table) {
            $table->id('id_katalog');          // Primary key
            $table->string('nama');            // Nama produk
            $table->text('deskripsi')->nullable(); // Deskripsi produk, opsional
            $table->decimal('harga', 10, 2);   // Harga produk dengan 2 angka desimal
            $table->integer('stok');           // Stok produk
            $table->timestamps();              // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('katalog');
    }
}
