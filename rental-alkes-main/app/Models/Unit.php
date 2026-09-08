<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Kembalikan nama relasinya menjadi category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}