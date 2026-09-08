<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriUnit extends Model
{
    protected $table = 'categories'; // <-- Tambahkan baris ini agar sinkron ke tabel yang berisi data

    protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];

    public function units()
    {
        return $this->hasMany(Unit::class, 'category_id');
    }
}