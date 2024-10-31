<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table ='transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;

    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'jumlah',
        'harga_satuan',
        'harga_total',
        'tanggal_transaksi',
        'keterangan',
    ];

    // Definisikan relasi barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    }

