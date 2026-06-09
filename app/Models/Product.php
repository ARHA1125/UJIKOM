<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'nama_barang',
        'deskripsi',
        'harga',
        'stok',
        'foto'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}