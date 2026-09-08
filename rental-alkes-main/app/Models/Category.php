<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori', 'deskripsi'];

    // Relasi ke Master Unit (jika satu kategori punya banyak unit)
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}