<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyewaan_id', // Menggunakan penyewaan_id sesuai migrasi
        'tanggal_kembali',
        'kondisi_unit',
        'denda',
        'catatan'
    ];

    /**
     * Relasi ke tabel Penyewaans
     * Dari penyewaan ini nanti kita bisa tarik data Customer & Unit
     */
    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'penyewaan_id');
    }
}