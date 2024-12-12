<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{

    use HasFactory;
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    public $incrementing = false; // Tidak auto increment
    protected $keyType = 'string'; 

    protected $fillable = ['id_pembelian', 'tanggal_pembelian', 'supplier', 'total_harga', 'image'];

    public function details()
    {
        return $this->hasMany(Detail_Pembelian::class, 'id_pembelian');
    }
}
