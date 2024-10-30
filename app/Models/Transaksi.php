<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'jumlah',
        'harga_satuan',
        'harga_total',
        'tanggal_transaksi',
        'keterangan',
    ];

    // Definisikan relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
