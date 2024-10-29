<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_Masuk extends Model
{

    use HasFactory;

    protected $table ='barangmasuk';
    protected $primaryKey = 'id_masuk';
    public $incrementing = false;

    protected $fillable=[
        'id_masuk', 
        'id_barang', 
        'jumlah', 
        'harga_satuan', 
        'harga_total', 
        'supplier', 
        'tanggal_masuk',
    ];

     // Definisi relasi ke model Barang
     public function barang()
     {
         return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
     }
 
    }

