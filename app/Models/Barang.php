<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{

    use HasFactory;

    protected $table ='barangs';
    protected $primaryKey = 'id_barang';
    public $incrementing = false;

    protected $fillable=[
        'id_barang', 
        'name', 
        'stok', 
        'harga', 
        'deskripsi', 
        'image', 
        'id_merek', 
        'id_kategori'
    ];

     // Definisi relasi ke model Brand
     public function brand()
     {
         return $this->belongsTo(Brand::class, 'id_merek', 'id_merek');
     }
 
     // Definisi relasi ke model Category
     public function category()
     {
         return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
     }
 }
