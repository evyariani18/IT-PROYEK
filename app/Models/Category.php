<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;
    protected $table ='categories';
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;

    protected $fillable = ['id_kategori', 'name'];
}
