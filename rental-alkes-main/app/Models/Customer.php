<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, 'customer_id');
    }

    public function kontraks()
    {
        return $this->hasMany(Kontrak::class, 'customer_id');
    }
}