<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kontrak',
        'customer_id',
        'unit_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'status_pembayaran', // Cukup 1 ini aja biar klop sama Controller
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}