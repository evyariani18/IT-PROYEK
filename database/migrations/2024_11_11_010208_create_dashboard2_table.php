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
        Schema::create('dashboard2', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama barang
            $table->unsignedBigInteger('category_id'); // Gunakan unsignedBigInteger
            $table->unsignedBigInteger('brand_id'); // Gunakan unsignedBigInteger
            $table->integer('stock');
            $table->decimal('price', 15, 2);
        
            // Menambahkan constraint foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard2');
    }
};
