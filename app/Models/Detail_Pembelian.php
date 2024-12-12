<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Pembelian extends Model
{

    use HasFactory;

    protected $table = 'detail_pembelian';
    protected $primaryKey = 'id_detailbeli';
    public $incrementing = false;

    protected $fillable = [
        'id_pembelian', 
        'id_barang', 
        'jumlah', 
        'harga_satuan',
        'sub_total'];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
