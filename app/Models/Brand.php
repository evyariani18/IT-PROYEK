<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table ='brands';
    protected $primaryKey = 'id_merek';
    public $incrementing = false;

    protected $fillable = ['id_merek', 'title'];

    //Funsi untuk generate ID Otomatis
    
}
